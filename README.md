📦 Filament Lock Screen

A lightweight lock screen system for Filament v3 that automatically locks inactive admin sessions and requires password re-authentication to continue.

✨ Features
🔐 Auto lock after inactivity
🔓 Secure password unlock (no logout required)
⚡ Middleware-based session tracking
🧩 Fully compatible with Filament v3
🎨 Customizable lock screen UI
📦 Easy Composer installation
🧱 Clean architecture (no external dependencies)
📥 Installation

Install via Composer:

composer require mohamed/filament-lockscreen
⚙️ Publish Config
php artisan vendor:publish --tag=filament-lockscreen-config

This will publish:

config/lockscreen.php
🎨 Publish Views (optional)
php artisan vendor:publish --tag=filament-lockscreen-views
⚙️ Configuration

Edit config/lockscreen.php:

return [
    'timeout' => env('LOCKSCREEN_TIMEOUT', 900), // seconds (15 minutes)
    'route' => 'admin/lock-screen',
];
🧠 How It Works
1. Middleware tracks activity
Stores last user activity in session
Checks inactivity time
Locks session if timeout exceeded
2. Redirect middleware
If session is locked
User is redirected to lock screen page
3. Unlock flow
User enters password
System validates using Hash::check
Session is unlocked without logout
🔌 Register Middleware

Add to your Filament Panel Provider:

->middleware([
    \Mohamed\FilamentLockscreen\Http\Middleware\LockscreenMiddleware::class,
    \Mohamed\FilamentLockscreen\Http\Middleware\RedirectIfLocked::class,
])
🖥 Lock Screen Page

Default route:

/admin/lock-screen

It shows:

Password input
Unlock button
Session restore on success
🔓 Unlock Behavior

When user submits password:

Password is verified
Session lock is removed
User is redirected back to dashboard
⏱ Default Timeout
900 seconds (15 minutes)

You can change it:

LOCKSCREEN_TIMEOUT=1200
🧩 Folder Structure
src/
 ├── Filament/Pages/LockScreen.php
 ├── Http/Middleware/LockscreenMiddleware.php
 ├── Http/Middleware/RedirectIfLocked.php
 └── LockscreenServiceProvider.php
🚀 Usage Example

After installation, everything works automatically:

User logs into Filament
System tracks activity
After inactivity → session locks
User is redirected to lock screen
Password unlock restores session
🔒 Security Notes
Uses Laravel Hash::check
Does NOT store plaintext passwords
Session-based locking only
No database changes required
🧪 Roadmap
 PIN unlock option
 Blur overlay mode (no redirect)
 Multi-panel support
 Biometric/WebAuthn support
 Admin-configurable timeout UI
📄 License

MIT License © Mohamed