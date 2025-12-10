# WORKZY Database Entity Relationship Diagram (ERD)

## Visual Schema

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                                                                             │
│                            WORKZY DATABASE SCHEMA                           │
│                                                                             │
└─────────────────────────────────────────────────────────────────────────────┘


                        ┌──────────────────────┐
                        │       USERS          │
                        ├──────────────────────┤
                        │ PK: id               │
                        │     name             │
                        │     email (unique)   │
                        │     password         │
                        │     role             │◄─────────┐
                        │     bio              │          │
                        │     skills           │          │
                        │     hourly_rate      │          │
                        │     location         │          │
                        │     phone            │          │
                        │     company          │          │
                        │     ...              │          │
                        └──────┬───────────────┘          │
                               │                          │
            ┌──────────────────┼──────────────────┐       │
            │                  │                  │       │
            │ 1:N              │ 1:N              │ 1:N   │
            │ (client)         │ (freelancer)     │       │
            │                  │                  │       │
            ▼                  ▼                  ▼       │
┌───────────────────┐  ┌──────────────────┐  ┌──────────────────┐
│     ORDERS        │  │    PROJECTS      │  │   WITHDRAWALS    │
├───────────────────┤  ├──────────────────┤  ├──────────────────┤
│ PK: id            │  │ PK: id           │  │ PK: id           │
│ FK: user_id       │  │ FK: user_id      │──┤ FK: user_id      │
│ FK: freelancer_id │──┤    title         │  │     amount       │
│     job_title     │  │    description   │  │     payment_     │
│     job_desc      │  │    image         │  │     method       │
│     requirements  │  │    url           │  │     status       │
│     price         │  │    technologies  │  │     admin_notes  │
│     deadline      │  │    is_featured   │  │     requested_at │
│     status        │  └──────────────────┘  │     processed_at │
│     payment_      │                        └──────────────────┘
│     method        │
│     delivery_     │
│     message       │
│     delivery_file │
│     delivered_at  │
│     paid_at       │
└─────┬─────────────┘
      │
      │ 1:1
      │
      ├──────────────────┐
      │                  │
      ▼                  ▼
┌──────────────┐   ┌──────────────────┐
│   REVIEWS    │   │    MESSAGES      │
├──────────────┤   ├──────────────────┤
│ PK: id       │   │ PK: id           │
│ FK: order_id │   │ FK: sender_id    │───┐
│ FK: user_id  │   │ FK: receiver_id  │───┼───┐
│ FK: freelan- │   │ FK: order_id     │   │   │
│     cer_id   │   │     message      │   │   │
│     rating   │   │     is_read      │   │   │
│     comment  │   └──────────────────┘   │   │
│     title    │                          │   │
│     quality_ │                          │   │
│     rating   │                          │   │
│     communi- │                          │   │
│     cation_  │      ┌───────────────────┘   │
│     rating   │      │                       │
│     deadline_│      │   ┌───────────────────┘
│     rating   │      │   │
│     profess- │      │   │  Both link back to USERS
│     ional_   │      │   │
│     rating   │      ▼   ▼
│     helpful_ │   ┌──────────────────┐
│     count    │   │      USERS       │
│     is_verif-│   │  (Referenced)    │
│     ied      │   └──────────────────┘
│     is_publi-│
│     shed     │
└──────────────┘


┌───────────────────────────────────────────────────────────────────┐
│                    SYSTEM TABLES                                  │
├───────────────────────────────────────────────────────────────────┤
│                                                                   │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐           │
│  │   SESSIONS   │  │    CACHE     │  │   CACHE_     │           │
│  │              │  │              │  │   LOCKS      │           │
│  ├──────────────┤  ├──────────────┤  ├──────────────┤           │
│  │ PK: id       │  │ PK: key      │  │ PK: key      │           │
│  │ FK: user_id  │  │     value    │  │     owner    │           │
│  │     payload  │  │     exp...   │  │     exp...   │           │
│  │     ip_addr  │  └──────────────┘  └──────────────┘           │
│  │     user_ag  │                                                │
│  │     last_ac  │                                                │
│  └──────────────┘                                                │
│                                                                   │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐           │
│  │    JOBS      │  │ JOB_BATCHES  │  │ FAILED_JOBS  │           │
│  │              │  │              │  │              │           │
│  ├──────────────┤  ├──────────────┤  ├──────────────┤           │
│  │ PK: id       │  │ PK: id       │  │ PK: id       │           │
│  │     queue    │  │     name     │  │     uuid     │           │
│  │     payload  │  │     total_   │  │     connec   │           │
│  │     attempts │  │     jobs     │  │     queue    │           │
│  │     reserved │  │     pending  │  │     payload  │           │
│  │     availab  │  │     failed   │  │     except   │           │
│  └──────────────┘  └──────────────┘  └──────────────┘           │
│                                                                   │
│  ┌──────────────────────────────────┐                            │
│  │   PASSWORD_RESET_TOKENS          │                            │
│  │                                  │                            │
│  ├──────────────────────────────────┤                            │
│  │ PK: email                        │                            │
│  │     token                        │                            │
│  │     created_at                   │                            │
│  └──────────────────────────────────┘                            │
│                                                                   │
└───────────────────────────────────────────────────────────────────┘
```

---

## Relationships Summary

### Users (Central Entity)

**1:N Relationships:**
- Users → Orders (as client via `user_id`)
- Users → Orders (as freelancer via `freelancer_id`)
- Users → Projects (portfolio)
- Users → Withdrawals
- Users → Messages (as sender)
- Users → Messages (as receiver)
- Users → Reviews (as reviewer)
- Users → Reviews (as reviewee)
- Users → Sessions

### Orders

**N:1 Relationships:**
- Orders → Users (client)
- Orders → Users (freelancer)

**1:1 Relationships:**
- Orders → Reviews

**1:N Relationships:**
- Orders → Messages

### Messages

**N:1 Relationships:**
- Messages → Users (sender)
- Messages → Users (receiver)
- Messages → Orders

### Reviews

**N:1 Relationships:**
- Reviews → Orders
- Reviews → Users (reviewer)
- Reviews → Users (reviewee)

### Withdrawals

**N:1 Relationships:**
- Withdrawals → Users (freelancer)

### Projects

**N:1 Relationships:**
- Projects → Users (freelancer)

---

## Cardinality Details

```
USERS (1) ──────< (N) ORDERS (as client)
  │
  └──────────────< (N) ORDERS (as freelancer)
  │
  └──────────────< (N) PROJECTS
  │
  └──────────────< (N) WITHDRAWALS
  │
  └──────────────< (N) MESSAGES (as sender)
  │
  └──────────────< (N) MESSAGES (as receiver)
  │
  └──────────────< (N) REVIEWS (as reviewer)
  │
  └──────────────< (N) REVIEWS (as reviewee)
  │
  └──────────────< (N) SESSIONS


ORDERS (1) ──────< (1) REVIEWS
  │
  └──────────────< (N) MESSAGES
```

---

## Foreign Key Constraints

| Child Table | Foreign Key | Parent Table | On Delete |
|-------------|-------------|--------------|-----------|
| orders | user_id | users | CASCADE |
| orders | freelancer_id | users | SET NULL |
| messages | sender_id | users | CASCADE |
| messages | receiver_id | users | CASCADE |
| messages | order_id | orders | CASCADE |
| reviews | order_id | orders | CASCADE |
| reviews | user_id | users | CASCADE |
| reviews | freelancer_id | users | CASCADE |
| withdrawals | user_id | users | CASCADE |
| projects | user_id | users | CASCADE |
| sessions | user_id | users | - |

---

## Data Flow

### Order Lifecycle

```
1. Client creates ORDER
   └─> Inserts into ORDERS (user_id, freelancer_id, job_title, price, status='pending')

2. Client pays for ORDER
   └─> Updates ORDERS (status='paid', paid_at=NOW())

3. Freelancer accepts ORDER
   └─> Updates ORDERS (status='accepted')

4. Freelancer starts work
   └─> Updates ORDERS (status='in_progress')

5. Freelancer delivers work
   └─> Updates ORDERS (status='delivered', delivery_message, delivery_file, delivered_at=NOW())

6. Client approves work
   └─> Updates ORDERS (status='completed')

7. Client writes REVIEW
   └─> Inserts into REVIEWS (order_id, user_id, freelancer_id, rating, comment)

8. Freelancer requests WITHDRAWAL
   └─> Inserts into WITHDRAWALS (user_id, amount, payment_method, status='pending')

9. Admin approves WITHDRAWAL
   └─> Updates WITHDRAWALS (status='approved', processed_at=NOW())

10. Admin sends payment
    └─> Updates WITHDRAWALS (status='sent')
```

### Messaging Flow

```
1. User sends MESSAGE
   └─> Inserts into MESSAGES (sender_id, receiver_id, order_id, message, is_read=0)

2. Receiver reads MESSAGE
   └─> Updates MESSAGES (is_read=1)
```

---

## Database Normalization

The database follows **Third Normal Form (3NF)**:

1. **First Normal Form (1NF)**
   - All tables have primary keys
   - All columns contain atomic values
   - No repeating groups

2. **Second Normal Form (2NF)**
   - All non-key attributes are fully dependent on primary key
   - No partial dependencies

3. **Third Normal Form (3NF)**
   - No transitive dependencies
   - All non-key attributes depend only on primary key

### Example: Orders Table

- `order_id` → `user_id`, `freelancer_id`, `job_title`, `price`, `status`
- No derived or calculated fields stored
- Status transitions tracked via timestamps

---

## Indexes Strategy

### Primary Indexes
- All tables have `id` as PRIMARY KEY (clustered index)

### Unique Indexes
- `users.email` - Ensure email uniqueness
- `reviews.order_id` - One review per order

### Foreign Key Indexes
- Automatically created on all FK columns
- Improves JOIN performance

### Composite Indexes
- `messages(sender_id, receiver_id, created_at)` - Chat history queries
- `orders(freelancer_id, status)` - Freelancer dashboard
- `withdrawals(user_id, status)` - Withdrawal tracking

### Search Indexes
- `users.role` - Filter by user type
- `orders.status` - Filter by order status
- `reviews.rating` - Sort by rating

---

## Data Integrity Rules

### Check Constraints

1. **Reviews**
   - `rating BETWEEN 1 AND 5`
   - `quality_rating BETWEEN 1 AND 5`
   - `communication_rating BETWEEN 1 AND 5`
   - `deadline_rating BETWEEN 1 AND 5`
   - `professionalism_rating BETWEEN 1 AND 5`

2. **Withdrawals**
   - `amount >= 50.00` (minimum withdrawal)

### Business Rules

1. **Orders**
   - Cannot delete user if they have orders
   - Freelancer can be removed from order (SET NULL)

2. **Reviews**
   - Must be for completed order
   - One review per order (UNIQUE constraint)

3. **Messages**
   - Cannot send message to self (application logic)
   - Must be between order participants (application logic)

---

## Views and Aggregations

### v_freelancer_stats
Aggregates freelancer performance metrics

### v_order_stats
Groups orders by status with totals

### v_monthly_revenue
Tracks platform revenue over time

---

## Database Size Estimation

### For 1,000 Active Users

| Table | Est. Rows | Row Size | Total Size |
|-------|-----------|----------|------------|
| users | 1,000 | ~2 KB | ~2 MB |
| orders | 5,000 | ~1 KB | ~5 MB |
| messages | 50,000 | ~500 B | ~25 MB |
| reviews | 3,000 | ~800 B | ~2.4 MB |
| withdrawals | 2,000 | ~500 B | ~1 MB |
| projects | 500 | ~1 KB | ~500 KB |
| sessions | 1,000 | ~2 KB | ~2 MB |

**Total Estimated Size:** ~40 MB (data only)
**With Indexes:** ~80 MB
**With Logs:** ~120 MB

---

## Performance Considerations

1. **Query Optimization**
   - Use EXPLAIN to analyze queries
   - Leverage indexes for WHERE, JOIN, ORDER BY
   - Avoid SELECT *

2. **Caching**
   - Cache frequently accessed data
   - Use Redis/Memcached for sessions
   - Cache view results

3. **Archiving**
   - Archive old orders (>1 year)
   - Archive old messages (>6 months)
   - Keep active data small

4. **Partitioning**
   - Partition large tables by date
   - Consider partitioning messages by month
   - Partition orders by year

---

**Last Updated:** December 10, 2025
