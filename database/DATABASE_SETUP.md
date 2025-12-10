# WORKZY Database Setup Guide

## Overview

This guide will help you set up the MySQL database for the WORKZY Freelance Marketplace Platform.

## Database Information

- **Database Name:** `workzy`
- **Character Set:** `utf8mb4`
- **Collation:** `utf8mb4_unicode_ci`
- **Engine:** InnoDB
- **Total Tables:** 13

---

## Tables Structure

### Core Tables

1. **users** - User accounts (clients, freelancers, admins)
2. **orders** - Project orders and assignments
3. **messages** - Real-time chat messages
4. **reviews** - Ratings and reviews for completed orders
5. **withdrawals** - Freelancer withdrawal requests
6. **projects** - Freelancer portfolio projects

### System Tables

7. **sessions** - User session management
8. **password_reset_tokens** - Password reset functionality
9. **cache** - Application cache
10. **cache_locks** - Cache locking mechanism
11. **jobs** - Queue jobs
12. **job_batches** - Batch job tracking
13. **failed_jobs** - Failed queue jobs

---

## Setup Methods

### Method 1: Using the SQL File (Recommended)

#### Prerequisites
- XAMPP/WAMP/MAMP installed
- MySQL server running
- phpMyAdmin or MySQL command line access

#### Steps:

1. **Start MySQL Server**
   ```bash
   # For XAMPP
   Start XAMPP Control Panel > Start MySQL
   ```

2. **Import via phpMyAdmin**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Click "Import" tab
   - Choose file: `database/workzy_database_setup.sql`
   - Click "Go"

3. **OR Import via Command Line**
   ```bash
   # Navigate to project directory
   cd c:\xampp\htdocs\project-akhir

   # Import the SQL file
   mysql -u root -p < database/workzy_database_setup.sql
   ```

4. **Verify Installation**
   - Check if database `workzy` exists
   - Verify all 13 tables are created
   - Check if default users are inserted

---

### Method 2: Using Laravel Migrations

#### Prerequisites
- PHP >= 8.2 installed
- Composer installed
- Laravel project dependencies installed

#### Steps:

1. **Configure Environment**
   ```bash
   # Copy .env.example to .env
   cp .env.example .env
   ```

2. **Update .env File**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=workzy
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Create Database**
   ```sql
   CREATE DATABASE workzy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

---

## Database Configuration

### For MySQL (Production)

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=workzy
DB_USERNAME=root
DB_PASSWORD=your_password
```

### For SQLite (Development)

Update your `.env` file:

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE not needed for SQLite
```

---

## Default User Accounts

The setup includes 3 default user accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@workzy.com | admin123 |
| Freelancer | freelancer@workzy.com | freelancer123 |
| Client | client@workzy.com | client123 |

**⚠️ IMPORTANT: Change these passwords in production!**

---

## Database Schema Details

### Users Table

Stores all user accounts with role-based access:

- **Roles:** `user` (client), `freelancer`, `admin`
- **Key Fields:** name, email, password, role, bio, skills, hourly_rate
- **Additional:** phone, location, company details for clients

### Orders Table

Manages project orders through their lifecycle:

- **Statuses:** pending → paid → accepted → in_progress → delivered → completed
- **Additional Statuses:** cancelled, rejected
- **Key Fields:** job_title, job_description, price, deadline, status
- **Relationships:** Links to client (user_id) and freelancer (freelancer_id)

### Messages Table

Real-time messaging between clients and freelancers:

- **Key Fields:** sender_id, receiver_id, message, is_read
- **Features:** Supports order-specific conversations
- **Indexing:** Optimized for real-time polling (2-second intervals)

### Reviews Table

Rating system for completed orders:

- **Rating Scale:** 1-5 stars
- **Categories:** Overall, Quality, Communication, Deadline, Professionalism
- **Constraints:** One review per order, must be completed order
- **Key Fields:** rating, comment, helpful_count, is_published

### Withdrawals Table

Freelancer payout management:

- **Statuses:** pending → approved → sent (or rejected)
- **Minimum Amount:** $50.00
- **Payment Methods:** bank_transfer, paypal
- **Key Fields:** amount, payment_method, payment_details, status

---

## Database Views

### v_freelancer_stats

Aggregated statistics for each freelancer:

```sql
SELECT * FROM v_freelancer_stats WHERE id = 1;
```

Returns:
- Total orders
- Completed orders
- Average rating
- Total reviews
- Total earnings

### v_order_stats

Order statistics grouped by status:

```sql
SELECT * FROM v_order_stats;
```

### v_monthly_revenue

Monthly revenue breakdown:

```sql
SELECT * FROM v_monthly_revenue ORDER BY month DESC LIMIT 12;
```

---

## Stored Procedures

### sp_calculate_freelancer_earnings

Calculate freelancer earnings and available balance:

```sql
CALL sp_calculate_freelancer_earnings(
  1,                    -- freelancer_id
  @total_earnings,      -- OUT: Total earnings after 15% fee
  @available_balance,   -- OUT: Available for withdrawal
  @pending_withdrawals  -- OUT: Pending withdrawal amount
);

SELECT @total_earnings, @available_balance, @pending_withdrawals;
```

**Business Logic:**
- Platform Fee: 15% deducted from order price
- Available Balance = Total Earnings - Pending Withdrawals
- Only completed orders count toward earnings

---

## Indexes and Performance

### Optimized Indexes

The database includes multiple indexes for performance:

- **users:** role, location, role+created_at
- **orders:** status, deadline, user_id, freelancer_id, status+created_at
- **messages:** sender+receiver+created_at, is_read+receiver_id
- **reviews:** order_id, user_id, freelancer_id, rating
- **withdrawals:** user_id, status, user_id+status

### Query Performance Tips

1. Always use indexed columns in WHERE clauses
2. Avoid SELECT * - specify columns needed
3. Use LIMIT for pagination
4. Leverage foreign key relationships
5. Use views for complex aggregations

---

## Security Considerations

### Password Hashing

All passwords are hashed using bcrypt:

```php
// In Laravel
$hashedPassword = Hash::make('password');
```

### SQL Injection Prevention

Laravel's Eloquent ORM uses parameterized queries:

```php
// Safe - uses parameter binding
User::where('email', $email)->first();
```

### Foreign Key Constraints

All relationships enforce referential integrity:

- `ON DELETE CASCADE` - Deletes related records
- `ON DELETE SET NULL` - Nullifies foreign keys

---

## Backup and Restore

### Create Backup

```bash
# Backup entire database
mysqldump -u root -p workzy > workzy_backup_$(date +%Y%m%d).sql

# Backup structure only
mysqldump -u root -p --no-data workzy > workzy_structure.sql

# Backup data only
mysqldump -u root -p --no-create-info workzy > workzy_data.sql
```

### Restore Backup

```bash
mysql -u root -p workzy < workzy_backup_20251210.sql
```

---

## Troubleshooting

### Issue: "Database connection failed"

**Solution:**
1. Check MySQL service is running
2. Verify credentials in `.env`
3. Ensure database `workzy` exists
4. Check port 3306 is not blocked

### Issue: "Access denied for user"

**Solution:**
```sql
-- Grant permissions
GRANT ALL PRIVILEGES ON workzy.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
```

### Issue: "Table doesn't exist"

**Solution:**
```bash
# Re-run migrations
php artisan migrate:fresh

# OR re-import SQL file
mysql -u root -p workzy < database/workzy_database_setup.sql
```

### Issue: "Foreign key constraint fails"

**Solution:**
1. Check parent record exists
2. Verify foreign key value is valid
3. Disable foreign key checks temporarily:
   ```sql
   SET FOREIGN_KEY_CHECKS = 0;
   -- Your query
   SET FOREIGN_KEY_CHECKS = 1;
   ```

---

## Testing the Database

### Test Queries

```sql
-- Check all tables
SHOW TABLES;

-- Count records in each table
SELECT 'users' AS table_name, COUNT(*) AS count FROM users
UNION ALL
SELECT 'orders', COUNT(*) FROM orders
UNION ALL
SELECT 'messages', COUNT(*) FROM messages
UNION ALL
SELECT 'reviews', COUNT(*) FROM reviews
UNION ALL
SELECT 'withdrawals', COUNT(*) FROM withdrawals;

-- Test default users
SELECT id, name, email, role FROM users;

-- Test freelancer stats view
SELECT * FROM v_freelancer_stats;

-- Test stored procedure
CALL sp_calculate_freelancer_earnings(2, @te, @ab, @pw);
SELECT @te AS total_earnings, @ab AS available_balance, @pw AS pending_withdrawals;
```

---

## Migration Timeline

The database evolved through these migrations:

1. `0001_01_01_000000` - Base users, sessions, password_reset_tokens
2. `0001_01_01_000001` - Cache tables
3. `0001_01_01_000002` - Jobs tables
4. `2025_11_01_120954` - Add role to users
5. `2025_11_01_174420` - Create orders table
6. `2025_11_01_174835` - Create reviews table
7. `2025_11_02_101241` - Create projects table
8. `2025_12_04_034650` - Create messages table
9. `2025_12_04_064057` - Add additional fields to users
10. `2025_12_04_092911` - Add job_description to orders
11. `2025_12_04_093117` - Add deadline and requirements to orders
12. `2025_12_04_093733` - Add paid_status to orders
13. `2025_12_07_172133` - Add timestamp columns to orders
14. `2025_12_07_172359` - Add delivery fields to orders
15. `2025_12_07_172721` - Update orders status enum
16. `2025_12_07_173503` - Create withdrawals table

---

## Maintenance

### Regular Tasks

1. **Optimize Tables**
   ```sql
   OPTIMIZE TABLE users, orders, messages, reviews, withdrawals;
   ```

2. **Analyze Tables**
   ```sql
   ANALYZE TABLE users, orders, messages, reviews, withdrawals;
   ```

3. **Check Table Status**
   ```sql
   CHECK TABLE users, orders, messages, reviews, withdrawals;
   ```

4. **Repair Tables** (if needed)
   ```sql
   REPAIR TABLE table_name;
   ```

---

## Contact & Support

For database-related issues:

1. Check this documentation first
2. Review Laravel logs: `storage/logs/laravel.log`
3. Check MySQL error log
4. Consult the main README.md

---

## Version History

- **v1.0.0** (2025-12-10) - Initial database schema
  - 13 tables
  - 3 views
  - 1 stored procedure
  - Comprehensive indexes and constraints

---

**Made with ❤️ for WORKZY Platform**
