# Waste Not

**Waste Not** is a community-driven food-sharing web platform designed to reduce food waste by 
connecting food providers (Listers) with those in need (Receivers).
 Built using PHP, MySQL, HTML, CSS, and JavaScript.

## Live Demo

> [Visit Website](https://wastenot.rf.gd/) *(Hosted on InfinityFree)*  
> ⚠️ DNS may take up to 72 hours to propagate for new visitors.

---

## Features

### User Roles
- **Lister:** Can add and manage food listings.
- **Receiver:** Can browse and claim food listings.
- **Guest:** Can preview limited listings without login.

### Lister Dashboard
- Add food details, image, type (veg, non-veg, animal)
- Manual or map-based address input
- Pickup time, contact number, and optional half-price tag
- Listing history for easy tracking

### Receiver Dashboard
- View available listings with filters (type, search)
- See expiration status and pickup time
- Open map to view pickup location

### Guest View
- Preview recent listings in slider
- Prompt to sign up for full access

### Contact Us
- PHP mailer-powered contact form for user queries

---

## Project Structure

- wastenot/
│
├── actions/ # Backend PHP scripts
├── auth/ # Login and signup pages
├── css/ # Stylesheets
├── images/ # Logo and other static images
├── includes/ # Database connection and footer
├── lister/ # Lister dashboard and form
├── pages/ # all the files 
├── PHPMailer/ # phpmailer used for connect us page
├── receiver/ # Receiver dashboard and explore guest view
├── scripts/ # JS for UI functionality
├── uploads/ # Uploaded food images
└── index.php # Homepage


---

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, PHPMailer
- **Database:** MySQL
- **Hosting:** InfinityFree
- **Map Integration:** Leaflet.js

---

## Setup Instructions

1. Clone the repo:
   ```bash
   git clone https://github.com/ayaan-gundkalli/wastenot.git

2. import Database:
   Import wastenot_db.sql into your local or online PHPMyAdmin.

3. Configure database connection in includes/db.php:
   $conn = new mysqli('localhost', 'root', '', 'wastenot');


4. Start your local server (XAMPP, WAMP, etc.) and access the project via:
   http://localhost/wastenot/

---

## License
This project is open-source and free to use under the MIT License.

## Credits
Developed by Ayaan Gundklle
As an internship project for Infi-Pre IT Services, Goa