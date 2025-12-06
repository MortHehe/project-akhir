# WORKZY - Data Flow Diagram (DFD)

## System Overview
WORKZY is a freelance marketplace platform connecting clients with freelancers for project-based work.

---

## Context Diagram (Level 0)

```
┌─────────────┐
│   Client    │
│   (User)    │
└──────┬──────┘
       │
       │ • Registration/Login
       │ • Create Orders
       │ • Make Payments
       │ • Send Messages
       │ • Write Reviews
       │
       ▼
┌─────────────────────────────┐
│                             │
│    WORKZY PLATFORM          │
│  (Freelance Marketplace)    │
│                             │
└─────────────┬───────────────┘
              │
              │ • Registration/Login
              │ • View/Accept Orders
              │ • Update Progress
              │ • Deliver Work
              │ • Receive Payments
              │ • Send Messages
              │
              ▼
        ┌──────────┐
        │Freelancer│
        └──────────┘

External Entities:
┌─────────────┐
│   Payment   │
│   Gateway   │
└─────────────┘
```

---

## Level 1 DFD - Main Processes

```
┌─────────┐
│ Client  │
└────┬────┘
     │
     │ 1. Login credentials
     ▼
┌─────────────────────┐         ┌──────────────┐
│  1.0 User           │◄───────►│  D1: Users   │
│  Authentication     │         └──────────────┘
└──────┬──────────────┘
       │ 2. User session
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│  2.0 Order          │◄───────►│  D2: Orders  │
│  Management         │         └──────────────┘
└──────┬──────────────┘
       │ 3. Order details
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│  3.0 Payment        │◄───────►│ D3: Payments │
│  Processing         │         └──────────────┘
└──────┬──────────────┘
       │ 4. Payment confirmation
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│  4.0 Messaging      │◄───────►│ D4: Messages │
│  System             │         └──────────────┘
└──────┬──────────────┘
       │ 5. Chat messages
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│  5.0 Review         │◄───────►│ D5: Reviews  │
│  Management         │         └──────────────┘
└──────┬──────────────┘
       │ 6. Review data
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│  6.0 Profile        │◄───────►│ D1: Users    │
│  Management         │         └──────────────┘
└─────────────────────┘
       │
       │ 7. Profile info
       ▼
┌─────────┐
│Freelancer│
└──────────┘
```

---

## Level 2 DFD - Detailed Processes

### 2.1 User Authentication Process

```
┌─────────┐
│  User   │
└────┬────┘
     │
     │ Registration data
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 1.1 Register        │────────►│  D1: Users   │
│ (Client/Freelancer) │         └──────────────┘
└─────────────────────┘
     │
     │ Login credentials
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 1.2 Validate        │◄───────►│  D1: Users   │
│ Credentials         │         └──────────────┘
└──────┬──────────────┘
       │ Valid/Invalid
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 1.3 Create          │────────►│ D6: Sessions │
│ Session             │         └──────────────┘
└──────┬──────────────┘
       │ Session token
       ▼
┌─────────┐
│  User   │
└─────────┘
```

### 2.2 Order Management Process

```
┌─────────┐
│ Client  │
└────┬────┘
     │
     │ Order request
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 2.1 Create Order    │────────►│  D2: Orders  │
│                     │         └──────────────┘
└─────────────────────┘
     │
     │ Order ID
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 2.2 Assign          │◄───────►│  D2: Orders  │
│ Freelancer          │         └──────────────┘
└──────┬──────────────┘
       │ Assignment notification
       │
       ▼
┌─────────┐
│Freelancer│
└────┬─────┘
     │
     │ Accept/Reject
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 2.3 Update Order    │◄───────►│  D2: Orders  │
│ Status              │         └──────────────┘
└──────┬──────────────┘
       │ Status: paid/accepted/in_progress/delivered
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 2.4 Track           │◄───────►│  D2: Orders  │
│ Progress            │         └──────────────┘
└──────┬──────────────┘
       │ Progress updates
       ▼
┌─────────┐
│ Client  │
└─────────┘
```

### 2.3 Payment Processing

```
┌─────────┐
│ Client  │
└────┬────┘
     │
     │ Payment details
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 3.1 Calculate       │◄───────►│  D2: Orders  │
│ Total Amount        │         └──────────────┘
└──────┬──────────────┘
       │ Amount (price + fees)
       │
       ▼
┌─────────────────────┐         ┌─────────────┐
│ 3.2 Process         │────────►│   Payment   │
│ Payment             │◄────────│   Gateway   │
└──────┬──────────────┘         └─────────────┘
       │ Payment confirmation
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 3.3 Update          │────────►│ D3: Payments │
│ Payment Record      │         └──────────────┘
└──────┬──────────────┘
       │
       │ Update order status
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 3.4 Update Order    │────────►│  D2: Orders  │
│ to Paid             │         └──────────────┘
└──────┬──────────────┘
       │ Payment notification
       ▼
┌─────────┐
│Freelancer│
└──────────┘
```

### 2.4 Messaging System

```
┌─────────┐
│  User   │
└────┬────┘
     │
     │ Message content
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 4.1 Create          │────────►│ D4: Messages │
│ Message             │         └──────────────┘
└─────────────────────┘
     │
     │ Message ID
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 4.2 Store Message   │────────►│ D4: Messages │
│ with Timestamp      │         └──────────────┘
└──────┬──────────────┘
       │ Query new messages
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 4.3 Poll New        │◄───────►│ D4: Messages │
│ Messages (2s)       │         └──────────────┘
└──────┬──────────────┘
       │ New messages
       │
       ▼
┌─────────────────────┐
│ 4.4 Display in      │
│ Real-time Chat UI   │
└──────┬──────────────┘
       │ Chat conversation
       ▼
┌─────────┐
│Recipient│
└─────────┘
```

### 2.5 Review Management

```
┌─────────┐
│ Client  │
└────┬────┘
     │
     │ Review data (rating, comment)
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 5.1 Validate        │◄───────►│  D2: Orders  │
│ Order Completed     │         └──────────────┘
└──────┬──────────────┘
       │ Valid
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 5.2 Create Review   │────────►│ D5: Reviews  │
│                     │         └──────────────┘
└─────────────────────┘
     │
     │ Review ID
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 5.3 Calculate       │◄───────►│ D5: Reviews  │
│ Average Rating      │         └──────────────┘
└──────┬──────────────┘
       │ Updated rating
       │
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 5.4 Update          │────────►│  D1: Users   │
│ Freelancer Profile  │         └──────────────┘
└──────┬──────────────┘
       │ Review notification
       ▼
┌─────────┐
│Freelancer│
└──────────┘
```

### 2.6 Profile Management

```
┌─────────┐
│  User   │
└────┬────┘
     │
     │ Profile updates
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 6.1 Update Profile  │────────►│  D1: Users   │
│ Information         │         └──────────────┘
└─────────────────────┘
     │
     │ Skills data (freelancer)
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 6.2 Manage Skills   │────────►│  D1: Users   │
│ & Expertise         │         └──────────────┘
└─────────────────────┘
     │
     │ View profile request
     ▼
┌─────────────────────┐         ┌──────────────┐
│ 6.3 Display Public  │◄───────►│  D1: Users   │
│ Profile             │         └──────────────┘
└──────┬──────────────┘
       │
       │ Get reviews
       ▼
┌─────────────────────┐         ┌──────────────┐
│ 6.4 Fetch Reviews & │◄───────►│ D5: Reviews  │
│ Completed Orders    │         └──────────────┘
└──────┬──────────────┘
       │ Profile data
       ▼
┌─────────┐
│ Visitor │
└─────────┘
```

---

## Data Stores

### D1: Users
- **Attributes**: id, name, email, password, role (user/freelancer/admin), bio, skills, hourly_rate, experience_years, location, job_title, created_at, updated_at
- **Primary Key**: id

### D2: Orders
- **Attributes**: id, user_id, freelancer_id, job_title, job_description, requirements, price, deadline, status (pending/paid/accepted/in_progress/delivered/completed/cancelled/rejected), payment_method, paid_at, created_at, updated_at
- **Primary Key**: id
- **Foreign Keys**: user_id → Users(id), freelancer_id → Users(id)

### D3: Payments
- **Attributes**: id, order_id, amount, platform_fee, processing_fee, total_amount, payment_method, transaction_id, status, paid_at
- **Primary Key**: id
- **Foreign Key**: order_id → Orders(id)

### D4: Messages
- **Attributes**: id, sender_id, receiver_id, message, is_read, created_at, updated_at
- **Primary Key**: id
- **Foreign Keys**: sender_id → Users(id), receiver_id → Users(id)

### D5: Reviews
- **Attributes**: id, order_id, user_id, freelancer_id, rating, comment, is_published, helpful_count, created_at, updated_at
- **Primary Key**: id
- **Foreign Keys**: order_id → Orders(id), user_id → Users(id), freelancer_id → Users(id)

### D6: Sessions
- **Attributes**: id, user_id, token, ip_address, user_agent, last_activity
- **Primary Key**: id
- **Foreign Key**: user_id → Users(id)

---

## Data Flows

### Client User Flows
1. **Registration** → Users table
2. **Login** → Validate credentials → Create session
3. **Find Freelancers** → Read Users (role=freelancer) + Reviews
4. **Create Order** → Write Orders (status=pending)
5. **Make Payment** → Write Payments → Update Orders (status=paid)
6. **Send Message** → Write Messages
7. **View Order Progress** → Read Orders
8. **Write Review** → Write Reviews (when order completed)

### Freelancer User Flows
1. **Registration** → Users table (role=freelancer)
2. **Login** → Validate credentials → Create session
3. **View Orders** → Read Orders (freelancer_id = user_id)
4. **Accept/Reject Order** → Update Orders (status=accepted/rejected)
5. **Start Progress** → Update Orders (status=in_progress)
6. **Deliver Work** → Update Orders (status=delivered)
7. **Receive Payment** → Payment released after client approval
8. **Update Profile** → Update Users (skills, bio, hourly_rate, etc.)
9. **Send Message** → Write Messages
10. **View Reviews** → Read Reviews (freelancer_id = user_id)

### Admin User Flows
1. **Manage Users** → CRUD on Users table
2. **Manage Orders** → CRUD on Orders table
3. **View Platform Analytics** → Aggregate queries on all tables

---

## Order Status Flow

```
PENDING
   ↓ (Client pays)
PAID
   ↓ (Freelancer accepts)
ACCEPTED
   ↓ (Freelancer starts work)
IN_PROGRESS
   ↓ (Freelancer delivers)
DELIVERED
   ↓ (Client approves)
COMPLETED
   ↓ (Client can review)
REVIEWED
```

Alternative paths:
- PENDING → CANCELLED (Client cancels)
- PAID → REJECTED (Freelancer rejects)

---

## Key Business Rules

1. **Authentication**
   - Users must register with unique email
   - Three roles: user (client), freelancer, admin
   - Role determines dashboard and available features

2. **Order Management**
   - Only clients can create orders
   - Orders can be assigned to specific freelancer or open to all
   - Payment must be completed before freelancer can accept
   - Only assigned freelancer can update order status

3. **Payment Processing**
   - Total = Project Cost + Platform Fee (5%) + Processing Fee (2.9% + $0.30)
   - Payment required before order moves to "paid" status
   - Supports multiple payment methods

4. **Messaging**
   - Real-time chat with 2-second polling
   - Messages stored permanently
   - Only between order participants (client ↔ freelancer)

5. **Reviews**
   - Only clients can write reviews
   - Reviews only possible after order completion
   - Average rating calculated and displayed on freelancer profile
   - Reviews are published and visible on public profiles

6. **Profile Visibility**
   - Freelancer profiles are public
   - Clients can view freelancer profiles before creating orders
   - Profile shows: bio, skills, hourly rate, completed projects, reviews, average rating

---

## Security Considerations

1. **Authentication**
   - Password hashing (bcrypt)
   - CSRF token validation
   - Session-based authentication

2. **Authorization**
   - Role-based access control (CheckRole middleware)
   - Users can only access their own data
   - Order access restricted to participants

3. **Data Validation**
   - Server-side validation for all inputs
   - XSS prevention (escapeHtml in messages)
   - SQL injection prevention (Eloquent ORM)

4. **Payment Security**
   - No storage of sensitive card data
   - Payment gateway integration for PCI compliance
   - Transaction verification

---

## Technology Stack

- **Backend**: Laravel 12.x (PHP)
- **Database**: MySQL
- **Frontend**: Blade Templates, HTML/CSS/JavaScript
- **Real-time**: AJAX polling (2-second interval)
- **Authentication**: Laravel Auth
- **Payment**: Integrated payment gateway
- **Admin Panel**: Filament

---

*Document created for WORKZY Freelance Platform*
*Date: December 6, 2025*
