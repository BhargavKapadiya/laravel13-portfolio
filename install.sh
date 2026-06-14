#!/bin/bash

# ============================================================
#  Laravel 13 Portfolio — Quick Install Script
#  Built by BK | Ahmedabad, Gujarat, India
#  GitHub: https://github.com/BhargavKapadiya/laravel13-portfolio
# ============================================================

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
WHITE='\033[1;37m'
NC='\033[0m' # No Color

# ============================================================
# BANNER
# ============================================================
echo ""
echo -e "${PURPLE}╔═══════════════════════════════════════════════════╗${NC}"
echo -e "${PURPLE}║                                                   ║${NC}"
echo -e "${PURPLE}║   🚀  Laravel 13 Portfolio — by BK               ║${NC}"
echo -e "${PURPLE}║       Ahmedabad, Gujarat, India                   ║${NC}"
echo -e "${PURPLE}║                                                   ║${NC}"
echo -e "${PURPLE}╚═══════════════════════════════════════════════════╝${NC}"
echo ""

# ============================================================
# HELPER FUNCTIONS
# ============================================================
print_step() {
    echo -e "${CYAN}▶ $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

# ============================================================
# CHECK REQUIREMENTS
# ============================================================
echo -e "${WHITE}Checking requirements...${NC}"
echo ""

# Check PHP
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -r "echo PHP_VERSION;")
    print_success "PHP found: v$PHP_VERSION"
else
    print_error "PHP not found. Please install PHP 8.3 or higher."
    exit 1
fi

# Check Composer
if command -v composer &> /dev/null; then
    COMPOSER_VERSION=$(composer --version --no-ansi | head -n 1)
    print_success "Composer found: $COMPOSER_VERSION"
else
    print_error "Composer not found. Please install Composer."
    exit 1
fi

# Check Node.js
if command -v node &> /dev/null; then
    NODE_VERSION=$(node -v)
    print_success "Node.js found: $NODE_VERSION"
else
    print_warning "Node.js not found. Skipping npm install."
fi

# Check NPM
if command -v npm &> /dev/null; then
    NPM_VERSION=$(npm -v)
    print_success "NPM found: v$NPM_VERSION"
fi

echo ""

# ============================================================
# STEP 1 — INSTALL PHP DEPENDENCIES
# ============================================================
print_step "Step 1/8 — Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader
if [ $? -eq 0 ]; then
    print_success "PHP dependencies installed!"
else
    print_error "Failed to install PHP dependencies."
    exit 1
fi
echo ""

# ============================================================
# STEP 2 — COPY ENV FILE
# ============================================================
print_step "Step 2/8 — Setting up environment file..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    print_success ".env file created from .env.example"
else
    print_warning ".env file already exists — skipping."
fi
echo ""

# ============================================================
# STEP 3 — GENERATE APP KEY
# ============================================================
print_step "Step 3/8 — Generating application key..."
php artisan key:generate --force
if [ $? -eq 0 ]; then
    print_success "Application key generated!"
else
    print_error "Failed to generate application key."
    exit 1
fi
echo ""

# ============================================================
# STEP 4 — DATABASE SETUP
# ============================================================
print_step "Step 4/8 — Database configuration..."
echo ""
echo -e "${YELLOW}Please enter your database details:${NC}"
echo ""

read -p "  Database Host [127.0.0.1]: " DB_HOST
DB_HOST=${DB_HOST:-127.0.0.1}

read -p "  Database Port [3306]: " DB_PORT
DB_PORT=${DB_PORT:-3306}

read -p "  Database Name [laravel13_portfolio]: " DB_DATABASE
DB_DATABASE=${DB_DATABASE:-laravel13_portfolio}

read -p "  Database Username [root]: " DB_USERNAME
DB_USERNAME=${DB_USERNAME:-root}

read -sp "  Database Password: " DB_PASSWORD
echo ""

# Update .env with database details
sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

print_success "Database configuration saved!"
echo ""

# ============================================================
# STEP 5 — RUN MIGRATIONS & SEEDERS
# ============================================================
print_step "Step 5/8 — Running database migrations..."
php artisan migrate --force
if [ $? -eq 0 ]; then
    print_success "Migrations completed!"
else
    print_error "Migration failed. Please check your database credentials."
    exit 1
fi

echo ""
print_step "Running database seeders..."
php artisan db:seed --force
if [ $? -eq 0 ]; then
    print_success "Seeders completed!"
else
    print_warning "Seeders failed — you can run them manually: php artisan db:seed"
fi
echo ""

# ============================================================
# STEP 6 — INSTALL NODE DEPENDENCIES & BUILD ASSETS
# ============================================================
if command -v npm &> /dev/null; then
    print_step "Step 6/8 — Installing Node dependencies..."
    npm install
    if [ $? -eq 0 ]; then
        print_success "Node dependencies installed!"
    fi

    echo ""
    print_step "Building assets..."
    npm run build
    if [ $? -eq 0 ]; then
        print_success "Assets built successfully!"
    else
        print_warning "Asset build failed — run: npm run build"
    fi
else
    print_warning "Step 6/8 — Skipping Node dependencies (Node.js not found)"
fi
echo ""

# ============================================================
# STEP 7 — STORAGE LINK & CACHE CLEAR
# ============================================================
print_step "Step 7/8 — Setting up storage & clearing cache..."

php artisan storage:link 2>/dev/null
print_success "Storage linked!"

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
print_success "Cache cleared!"
echo ""

# ============================================================
# STEP 8 — SET PERMISSIONS
# ============================================================
print_step "Step 8/8 — Setting folder permissions..."
chmod -R 775 storage bootstrap/cache 2>/dev/null
print_success "Permissions set!"
echo ""

# ============================================================
# DONE!
# ============================================================
echo -e "${PURPLE}╔═══════════════════════════════════════════════════╗${NC}"
echo -e "${PURPLE}║                                                   ║${NC}"
echo -e "${PURPLE}║   🎉  Installation Complete!                      ║${NC}"
echo -e "${PURPLE}║                                                   ║${NC}"
echo -e "${PURPLE}╚═══════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${WHITE}📋 Next Steps:${NC}"
echo ""
echo -e "  ${GREEN}1.${NC} Start the server:   ${CYAN}php artisan serve${NC}"
echo -e "  ${GREEN}2.${NC} Visit:              ${CYAN}http://localhost:8000${NC}"
echo -e "  ${GREEN}3.${NC} Admin login:        ${CYAN}admin@example.com${NC}"
echo -e "  ${GREEN}4.${NC} Password:           ${CYAN}password${NC}"
echo -e "  ${GREEN}5.${NC} Import Postman:     ${CYAN}postman_collection.json${NC}"
echo ""
echo -e "${YELLOW}⚠️  Please change your admin password after first login!${NC}"
echo ""
echo -e "${BLUE}📬 Need help? Contact: bhargavkapadiya80@gmail.com${NC}"
echo -e "${BLUE}🐙 GitHub: https://github.com/BhargavKapadiya/laravel13-portfolio${NC}"
echo ""
echo -e "${PURPLE}  Made with ❤️  by BK — Ahmedabad, Gujarat, India${NC}"
echo ""
