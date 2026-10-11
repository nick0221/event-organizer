# EventOrganizer - Master Project Plan & Architecture

## 1. Executive Summary

**EventOrganizer** is a comprehensive web application designed to streamline event management and customer bookings. It consists of two main interfaces:

1. **Admin Panel:** A robust dashboard for administrators to manage events, oversee the customer masterlist, and analyze business metrics.
2. **Customer Booking Portal:** A public-facing, highly interactive website where customers can browse events and book their desired dates seamlessly.

## 2. Tech Stack & Tooling

- **Backend:** Laravel 13 (PHP 8.3+)
- **Frontend Framework:** React 19
- **Glue:** Inertia.js 3 (React Starter Kit)
- **Styling:** Tailwind CSS 4 + shadcn/ui (for accessible, customizable components)
- **Animations:** Framer Motion (for fluid UI transitions and micro-interactions)
- **Database:** SQLite (Development/Initial) ➔ MySQL (Production/Scale)
- **Testing:** Pest PHP
- **Package Manager:** npm

## 3. Database Architecture (Initial SQLite Schema)

_Note: Designed with MySQL compatibility in mind for the future transition._

### Core Tables

- **`users`**: Authentication, roles (`admin`, `customer`), basic profile.
- **`customers`**: Masterlist details (linked to `users` or standalone for guest bookings). Includes phone, company, address, preferences.
- **`events`**: Title, description, category, base_price, total_capacity, status (draft, published, archived), start_date, end_date.
- **`event_schedules`**: Specific dates/times an event is available (allows recurring events or multiple slots).
- **`bookings`**: Links `customer` to `event_schedule`. Includes status (pending, confirmed, cancelled), total_amount, payment_status.
- **`booking_attendees`**: Individual guest details for a specific booking.

## 4. Feature Breakdown

### 4.1 Admin Panel (Protected Route)

- **Analytical Dashboard:** High-level metrics (Total Revenue, Upcoming Events, Conversion Rates) using Recharts/Chart.js.
- **Event Management:** CRUD operations for events and schedules. Bulk actions, status toggling.
- **Customer Masterlist:** DataTable with sorting, filtering, and searching. View individual customer booking history.
- **Booking Management:** View all bookings, manually confirm/cancel, process refunds.

### 4.2 Customer Booking Website (Public Route)

- **Landing Page:** Hero section with Framer Motion scroll animations, featured events, testimonials.
- **Event Catalog:** Grid/List view of available events with advanced filtering (date, category, price).
- **Event Details Page:** Rich media gallery, description, interactive calendar to select available dates.
- **Booking Flow:** Multi-step form (Select Date ➔ Enter Details ➔ Review & Pay) with smooth page transitions.
- **User Dashboard:** Customers can view their past and upcoming bookings, download invoices.

---

## 5. Project Phases & Progress Tracker

### Phase 1: Project Initialization & Environment Setup

- [ ] Define project requirements and tech stack.
- [ ] Create project directory at `D:/VibeCodeProjects/EventOrganizer`.
- [ ] Initialize Laravel 13 with the React starter kit.
- [ ] Install and configure Tailwind CSS 4, shadcn/ui, and Framer Motion.
- [ ] Setup Git repository and initial commit.

### Phase 2: Database Design & Core Backend

- [ ] Create Migrations for `users`, `customers`, `events`, `event_schedules`, `bookings`.
- [ ] Create Eloquent Models with proper relationships and scopes.
- [ ] Seed the database with dummy data (Admin user, sample events, customers) using Laravel Factories.

### Phase 3: Authentication & Authorization

- [ ] Configure Laravel Breeze/Jetstream or built-in starter kit auth for React.
- [ ] Implement Role-Based Access Control (RBAC) using Laravel Gates/Policies (Admin vs. Customer).
- [ ] Setup Inertia shared data for global user state and flash messages.

### Phase 4: Admin Panel Development

- [ ] Build Admin Layout (Sidebar, Topbar, responsive mobile menu) using shadcn/ui.
- [ ] Develop the Analytical Dashboard (Stat cards, revenue charts).
- [ ] Build Event Management module (DataTables, Create/Edit forms with rich text editor).
- [ ] Build Customer Masterlist module (Advanced filtering, export to CSV).
- [ ] Build Booking Management module (Status updates, timeline view).

### Phase 5: Customer Booking Portal

- [ ] Build Public Layout (Navbar, Footer) with Framer Motion page transitions.
- [ ] Develop Landing Page and Event Catalog (Grid layout, search/filter logic).
- [ ] Build Event Details Page with interactive date picker.
- [ ] Implement the Multi-step Booking Flow (Form validation, state management).
- [ ] Build Customer User Dashboard (Booking history, profile settings).

### Phase 6: UI/UX Polish & Animations

- [ ] Add Framer Motion micro-interactions (button hovers, modal entrances).
- [ ] Implement skeleton loaders for data fetching states.
- [ ] Ensure full mobile responsiveness across all Inertia pages.
- [ ] Optimize images and assets for web performance.

### Phase 7: Testing & Quality Assurance

- [ ] Write Feature tests for Booking flow and Event creation using **Pest PHP**.
- [ ] Write Unit tests for complex pricing and capacity calculation logic.
- [ ] Conduct cross-browser testing and accessibility (a11y) checks.

### Phase 8: Scaling & Deployment (SQLite to MySQL)

- [ ] Update `.env` configurations for MySQL.
- [ ] Run migrations on the MySQL database and verify data integrity.
- [ ] Optimize MySQL queries (add indexes to frequently searched columns like `event_date`, `customer_email`).
- [ ] Setup CI/CD pipeline (GitHub Actions) for automated Pest testing.
- [ ] Deploy to production server (e.g., Laravel Forge, Vercel for frontend if decoupled, or standard VPS).

---

## 6. Initial Setup Commands

Execute the following commands in your terminal to bootstrap the project:

```bash
# 1. Navigate to the parent directory
cd D:/VibeCodeProjects

# 2. Create the Laravel project using the exact specified command
laravel new event-organizer --react --database=sqlite --pest --npm --no-interaction --no-boost

# 3. Rename the folder to match the required Project Directory structure
ren event-organizer EventOrganizer

# 4. Navigate into the project folder
cd EventOrganizer

# 5. Install Frontend Dependencies (Framer Motion for animations)
npm install framer-motion

# 6. Initialize shadcn/ui (Follow prompts, ensure Tailwind 4 compatibility)
npx shadcn@latest init

# 7. Add essential shadcn components
npx shadcn@latest add button card input label dialog table dropdown-menu calendar

# 8. Run the development servers
composer run dev
```
