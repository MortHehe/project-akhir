#!/bin/bash

# ============================================================
# WORKZY Database Setup Script for Linux/Mac
# ============================================================

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}WORKZY Database Setup${NC}"
echo -e "${BLUE}========================================${NC}"
echo ""

# Check if MySQL is installed
echo -e "${YELLOW}[1/5] Checking MySQL installation...${NC}"
if command -v mysql &> /dev/null; then
    echo -e "${GREEN}[OK] MySQL is installed${NC}"
else
    echo -e "${RED}[ERROR] MySQL is not installed!${NC}"
    echo "Please install MySQL first:"
    echo "  Ubuntu/Debian: sudo apt-get install mysql-server"
    echo "  macOS: brew install mysql"
    exit 1
fi
echo ""

# Check if MySQL service is running
echo -e "${YELLOW}[2/5] Checking MySQL service...${NC}"
if pgrep -x mysqld > /dev/null || pgrep -x mysql > /dev/null; then
    echo -e "${GREEN}[OK] MySQL service is running${NC}"
else
    echo -e "${YELLOW}[WARNING] MySQL service may not be running${NC}"
    echo "Starting MySQL service..."

    # Try to start MySQL (different commands for different systems)
    if command -v systemctl &> /dev/null; then
        sudo systemctl start mysql || sudo systemctl start mysqld
    elif command -v service &> /dev/null; then
        sudo service mysql start || sudo service mysqld start
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        brew services start mysql
    fi
fi
echo ""

# Get project directory
PROJECT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# MySQL credentials
echo -e "${YELLOW}[3/5] MySQL Authentication${NC}"
read -p "Enter MySQL username [root]: " MYSQL_USER
MYSQL_USER=${MYSQL_USER:-root}

read -sp "Enter MySQL password (press Enter if no password): " MYSQL_PASS
echo ""
echo ""

# Test MySQL connection
echo -e "${YELLOW}[4/5] Testing MySQL connection...${NC}"
if [ -z "$MYSQL_PASS" ]; then
    mysql -u "$MYSQL_USER" -e "SELECT 1" &> /dev/null
else
    mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" -e "SELECT 1" &> /dev/null
fi

if [ $? -eq 0 ]; then
    echo -e "${GREEN}[OK] MySQL connection successful${NC}"
else
    echo -e "${RED}[ERROR] MySQL connection failed!${NC}"
    echo "Please check your credentials and try again"
    exit 1
fi
echo ""

# Import database
echo -e "${YELLOW}[5/5] Creating database and importing schema...${NC}"
echo "This may take a minute..."

if [ -z "$MYSQL_PASS" ]; then
    mysql -u "$MYSQL_USER" < "$PROJECT_DIR/database/workzy_database_setup.sql"
else
    mysql -u "$MYSQL_USER" -p"$MYSQL_PASS" < "$PROJECT_DIR/database/workzy_database_setup.sql"
fi

if [ $? -eq 0 ]; then
    echo -e "${GREEN}[OK] Database setup completed successfully!${NC}"
else
    echo -e "${RED}[ERROR] Database setup failed!${NC}"
    echo "Check the error messages above"
    exit 1
fi
echo ""

# Update .env file
echo -e "${YELLOW}Updating .env configuration...${NC}"
if [ ! -f "$PROJECT_DIR/.env" ]; then
    if [ -f "$PROJECT_DIR/.env.example" ]; then
        cp "$PROJECT_DIR/.env.example" "$PROJECT_DIR/.env"
        echo -e "${GREEN}[OK] Created .env from .env.example${NC}"
    else
        echo -e "${YELLOW}[WARNING] .env.example not found${NC}"
    fi
fi

# Update database settings in .env
if [ -f "$PROJECT_DIR/.env" ]; then
    # Backup .env
    cp "$PROJECT_DIR/.env" "$PROJECT_DIR/.env.backup"

    # Update database settings
    sed -i.bak 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' "$PROJECT_DIR/.env"
    sed -i.bak 's/DB_HOST=.*/DB_HOST=127.0.0.1/' "$PROJECT_DIR/.env"
    sed -i.bak 's/DB_PORT=.*/DB_PORT=3306/' "$PROJECT_DIR/.env"
    sed -i.bak 's/DB_DATABASE=.*/DB_DATABASE=workzy/' "$PROJECT_DIR/.env"
    sed -i.bak "s/DB_USERNAME=.*/DB_USERNAME=$MYSQL_USER/" "$PROJECT_DIR/.env"
    sed -i.bak "s/DB_PASSWORD=.*/DB_PASSWORD=$MYSQL_PASS/" "$PROJECT_DIR/.env"

    # Remove backup files
    rm -f "$PROJECT_DIR/.env.bak"

    echo -e "${GREEN}[OK] .env file updated with database credentials${NC}"
fi
echo ""

# Generate Laravel key if not exists
if [ -f "$PROJECT_DIR/artisan" ]; then
    if ! grep -q "APP_KEY=base64:" "$PROJECT_DIR/.env" 2>/dev/null; then
        echo -e "${YELLOW}Generating Laravel application key...${NC}"
        cd "$PROJECT_DIR"
        php artisan key:generate
        echo ""
    fi
fi

# Summary
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Setup Complete!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo -e "Database: ${BLUE}workzy${NC}"
echo -e "Tables Created: ${BLUE}13${NC}"
echo -e "Default Users Created: ${BLUE}3${NC}"
echo ""
echo -e "${YELLOW}Login Credentials:${NC}"
echo "  Admin:      admin@workzy.com / admin123"
echo "  Freelancer: freelancer@workzy.com / freelancer123"
echo "  Client:     client@workzy.com / client123"
echo ""
echo -e "${YELLOW}Next Steps:${NC}"
echo "  1. Check .env file for correct database settings"
echo "  2. Run: composer install (if not done)"
echo "  3. Run: php artisan migrate (optional, if using Laravel migrations)"
echo "  4. Run: php artisan serve"
echo "  5. Open: http://localhost:8000"
echo ""
echo -e "${RED}⚠️  IMPORTANT: Change default passwords in production!${NC}"
echo ""
echo -e "${GREEN}========================================${NC}"

# Make script executable
chmod +x "$0"
