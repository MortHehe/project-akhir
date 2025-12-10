# WORKZY Database Quick Reference

## Quick Start

### Windows (XAMPP)
```bash
# Double-click to run
setup-database.bat

# OR manually
mysql -u root -p < database/workzy_database_setup.sql
```

### Linux/Mac
```bash
# Make executable and run
chmod +x setup-database.sh
./setup-database.sh

# OR manually
mysql -u root -p < database/workzy_database_setup.sql
```

---

## Database Credentials

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=workzy
DB_USERNAME=root
DB_PASSWORD=
```

---

## Default Login Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@workzy.com | admin123 |
| Freelancer | freelancer@workzy.com | freelancer123 |
| Client | client@workzy.com | client123 |

---

## Tables Overview

### Core Tables (7)
1. **users** - User accounts
2. **orders** - Project orders
3. **messages** - Chat system
4. **reviews** - Ratings & reviews
5. **withdrawals** - Payout requests
6. **projects** - Portfolio items
7. **sessions** - User sessions

### System Tables (6)
8. password_reset_tokens
9. cache
10. cache_locks
11. jobs
12. job_batches
13. failed_jobs

---

## Common Queries

### Get All Users by Role
```sql
-- Get all freelancers
SELECT id, name, email, hourly_rate, bio
FROM users
WHERE role = 'freelancer'
ORDER BY created_at DESC;

-- Get all clients
SELECT id, name, email, company
FROM users
WHERE role = 'user'
ORDER BY created_at DESC;
```

### Get Orders by Status
```sql
-- Pending orders
SELECT o.id, o.job_title, o.price, u.name as client_name
FROM orders o
JOIN users u ON o.user_id = u.id
WHERE o.status = 'pending'
ORDER BY o.created_at DESC;

-- Active orders for a freelancer
SELECT o.id, o.job_title, o.price, o.status, u.name as client_name
FROM orders o
JOIN users u ON o.user_id = u.id
WHERE o.freelancer_id = ? -- Replace with freelancer ID
  AND o.status IN ('accepted', 'in_progress', 'delivered')
ORDER BY o.deadline ASC;
```

### Get Freelancer Earnings
```sql
-- Total earnings (after 15% platform fee)
SELECT
  SUM(price * 0.85) as total_earnings,
  COUNT(*) as completed_orders
FROM orders
WHERE freelancer_id = ? -- Replace with freelancer ID
  AND status = 'completed';
```

### Get Freelancer Reviews
```sql
SELECT
  r.rating,
  r.comment,
  r.created_at,
  u.name as client_name,
  o.job_title
FROM reviews r
JOIN users u ON r.user_id = u.id
JOIN orders o ON r.order_id = o.id
WHERE r.freelancer_id = ? -- Replace with freelancer ID
  AND r.is_published = 1
ORDER BY r.created_at DESC;
```

### Get Unread Messages
```sql
SELECT
  m.id,
  m.message,
  m.created_at,
  u.name as sender_name
FROM messages m
JOIN users u ON m.sender_id = u.id
WHERE m.receiver_id = ? -- Replace with user ID
  AND m.is_read = 0
ORDER BY m.created_at DESC;
```

### Get Pending Withdrawals
```sql
SELECT
  w.id,
  w.amount,
  w.payment_method,
  w.requested_at,
  u.name as freelancer_name,
  u.email
FROM withdrawals w
JOIN users u ON w.user_id = u.id
WHERE w.status = 'pending'
ORDER BY w.requested_at ASC;
```

---

## Statistics Queries

### Platform Overview
```sql
-- Total users by role
SELECT role, COUNT(*) as count
FROM users
GROUP BY role;

-- Total orders by status
SELECT status, COUNT(*) as count, SUM(price) as total_value
FROM orders
GROUP BY status;

-- Total revenue (15% platform fee)
SELECT
  COUNT(*) as total_completed_orders,
  SUM(price) as gross_revenue,
  SUM(price * 0.15) as platform_revenue
FROM orders
WHERE status = 'completed';
```

### Top Freelancers
```sql
SELECT
  u.id,
  u.name,
  u.email,
  COUNT(DISTINCT o.id) as total_orders,
  COALESCE(AVG(r.rating), 0) as avg_rating,
  COUNT(DISTINCT r.id) as total_reviews
FROM users u
LEFT JOIN orders o ON u.id = o.freelancer_id AND o.status = 'completed'
LEFT JOIN reviews r ON u.id = r.freelancer_id
WHERE u.role = 'freelancer'
GROUP BY u.id, u.name, u.email
HAVING total_orders > 0
ORDER BY avg_rating DESC, total_orders DESC
LIMIT 10;
```

### Recent Activity
```sql
-- Recent orders
SELECT
  o.id,
  o.job_title,
  o.status,
  o.price,
  c.name as client,
  f.name as freelancer,
  o.created_at
FROM orders o
JOIN users c ON o.user_id = c.id
LEFT JOIN users f ON o.freelancer_id = f.id
ORDER BY o.created_at DESC
LIMIT 10;
```

---

## Views

### Use Freelancer Stats View
```sql
SELECT *
FROM v_freelancer_stats
WHERE total_orders > 5
ORDER BY avg_rating DESC;
```

### Use Order Stats View
```sql
SELECT * FROM v_order_stats;
```

### Use Monthly Revenue View
```sql
SELECT *
FROM v_monthly_revenue
WHERE month >= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 12 MONTH), '%Y-%m')
ORDER BY month DESC;
```

---

## Stored Procedures

### Calculate Freelancer Balance
```sql
CALL sp_calculate_freelancer_earnings(
  2,                    -- freelancer_id
  @total_earnings,
  @available_balance,
  @pending_withdrawals
);

SELECT
  @total_earnings as 'Total Earnings',
  @available_balance as 'Available Balance',
  @pending_withdrawals as 'Pending Withdrawals';
```

---

## Order Status Flow

```
pending → paid → accepted → in_progress → delivered → completed
    ↓
cancelled
          ↓
       rejected
```

### Update Order Status
```sql
-- Mark as paid
UPDATE orders
SET status = 'paid', paid_at = NOW()
WHERE id = ?;

-- Accept order
UPDATE orders
SET status = 'accepted'
WHERE id = ? AND status = 'paid';

-- Start work
UPDATE orders
SET status = 'in_progress'
WHERE id = ? AND status = 'accepted';

-- Deliver work
UPDATE orders
SET status = 'delivered',
    delivery_message = 'Work completed',
    delivered_at = NOW()
WHERE id = ? AND status = 'in_progress';

-- Complete order
UPDATE orders
SET status = 'completed'
WHERE id = ? AND status = 'delivered';
```

---

## Withdrawal Status Flow

```
pending → approved → sent
    ↓
rejected
```

### Process Withdrawal
```sql
-- Approve withdrawal
UPDATE withdrawals
SET status = 'approved', processed_at = NOW()
WHERE id = ?;

-- Mark as sent
UPDATE withdrawals
SET status = 'sent', processed_at = NOW()
WHERE id = ?;

-- Reject withdrawal
UPDATE withdrawals
SET status = 'rejected',
    admin_notes = 'Reason for rejection',
    processed_at = NOW()
WHERE id = ?;
```

---

## Data Validation

### Before Creating Order
```sql
-- Check if user exists and is client
SELECT id FROM users
WHERE id = ? AND role = 'user';

-- Check if freelancer exists
SELECT id FROM users
WHERE id = ? AND role = 'freelancer';
```

### Before Creating Review
```sql
-- Check if order is completed
SELECT id FROM orders
WHERE id = ? AND status = 'completed';

-- Check if review already exists
SELECT id FROM reviews
WHERE order_id = ?;
```

### Before Creating Withdrawal
```sql
-- Check available balance
CALL sp_calculate_freelancer_earnings(?, @te, @ab, @pw);

-- Verify amount is valid
SELECT CASE
  WHEN @ab >= ? THEN 'Valid'
  ELSE 'Insufficient balance'
END as validation;
```

---

## Backup & Restore

### Backup Database
```bash
# Full backup
mysqldump -u root -p workzy > workzy_backup.sql

# Structure only
mysqldump -u root -p --no-data workzy > workzy_structure.sql

# Data only
mysqldump -u root -p --no-create-info workzy > workzy_data.sql

# Specific table
mysqldump -u root -p workzy users orders > workzy_partial.sql
```

### Restore Database
```bash
# Full restore
mysql -u root -p workzy < workzy_backup.sql

# Restore specific table
mysql -u root -p workzy < workzy_partial.sql
```

---

## Maintenance

### Optimize Tables
```sql
OPTIMIZE TABLE users, orders, messages, reviews, withdrawals;
```

### Analyze Tables
```sql
ANALYZE TABLE users, orders, messages, reviews, withdrawals;
```

### Check Table Status
```sql
SELECT
  table_name,
  table_rows,
  ROUND(((data_length + index_length) / 1024 / 1024), 2) AS "Size (MB)"
FROM information_schema.TABLES
WHERE table_schema = 'workzy'
ORDER BY (data_length + index_length) DESC;
```

### Clean Old Data
```sql
-- Archive old messages (older than 6 months)
DELETE FROM messages
WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH)
  AND is_read = 1;

-- Archive old sessions
DELETE FROM sessions
WHERE last_activity < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 DAY));
```

---

## Troubleshooting

### Reset Admin Password
```sql
-- Password: newpassword123
UPDATE users
SET password = '$2y$12$LQv3c1yycLGFY0JYd8X0Vu1nSRgQfRN9Q9JG5xGJ5YP5xGJ5xGJ5x'
WHERE email = 'admin@workzy.com';
```

### Fix Orphaned Records
```sql
-- Find orders without clients
SELECT * FROM orders
WHERE user_id NOT IN (SELECT id FROM users);

-- Find orders without valid freelancer
SELECT * FROM orders
WHERE freelancer_id IS NOT NULL
  AND freelancer_id NOT IN (SELECT id FROM users WHERE role = 'freelancer');
```

### Check Database Integrity
```sql
-- Check all tables
CHECK TABLE users, orders, messages, reviews, withdrawals, projects;

-- Check foreign keys
SELECT
  TABLE_NAME,
  CONSTRAINT_NAME,
  REFERENCED_TABLE_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'workzy'
  AND REFERENCED_TABLE_NAME IS NOT NULL;
```

---

## Performance Tips

1. **Use Indexes**
   - Always filter by indexed columns
   - Use composite indexes for multiple conditions

2. **Limit Results**
   - Always use LIMIT for large datasets
   - Implement pagination

3. **Avoid SELECT ***
   - Only select needed columns
   - Reduces network overhead

4. **Use JOINs Wisely**
   - Only join necessary tables
   - Use appropriate JOIN type

5. **Cache Results**
   - Cache frequently accessed data
   - Use Laravel's cache system

---

## Useful Commands

```sql
-- Show all tables
SHOW TABLES;

-- Describe table structure
DESCRIBE users;
SHOW CREATE TABLE orders;

-- Show indexes
SHOW INDEX FROM orders;

-- Show table size
SELECT
  table_name AS 'Table',
  ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.TABLES
WHERE table_schema = 'workzy';

-- Show running queries
SHOW PROCESSLIST;

-- Kill long-running query
KILL QUERY process_id;
```

---

## Laravel Artisan Commands

```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Create new migration
php artisan make:migration create_table_name

# Create new seeder
php artisan make:seeder TableSeeder

# Clear cache
php artisan cache:clear

# Generate application key
php artisan key:generate
```

---

## Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Install dependencies
composer install

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve
```

---

**Quick Links:**
- [Full Setup Guide](DATABASE_SETUP.md)
- [Entity Relationship Diagram](ERD.md)
- [Main README](../README.md)

**Last Updated:** December 10, 2025
