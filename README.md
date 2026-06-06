# Filament Lock Screen

A modern lock screen plugin for **Filament v3** that automatically locks inactive sessions and requires password re-authentication without logging users out.

<p align="center">
    <img src="https://img.shields.io/packagist/v/mohamed/filament-lock-screen.svg" alt="Latest Version">
    <img src="https://img.shields.io/packagist/dt/mohamed/filament-lock-screen.svg" alt="Total Downloads">
    <img src="https://img.shields.io/packagist/l/mohamed/filament-lock-screen.svg" alt="License">
</p>

---

## Features

* 🔒 Automatic session locking after inactivity
* 🔓 Secure password-based unlock
* 🎨 Modern overlay lock screen
* ⚡ Native Filament v3 integration
* 🧩 Plugin-based architecture
* 📡 Lock / Unlock events
* ⚙️ Configurable timeout
* 🚀 No database tables required
* 🔐 Session-based security
* 🎯 Easy installation and setup

---

## Requirements

| Package  | Version     |
| -------- | ----------- |
| PHP      | 8.1+        |
| Laravel  | 10.x / 11.x |
| Filament | 3.x         |

---

## Installation

Install the package via Composer:

```bash
composer require mohamed/filament-lock-screen
```

---

## Publish Configuration

```bash
php artisan vendor:publish --tag=filament-lock-screen-config
```

This will create:

```text
config/filament-lock-screen.php
```

---

## Configuration

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable Plugin
    |--------------------------------------------------------------------------
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Session Timeout (seconds)
    |--------------------------------------------------------------------------
    */

    'timeout' => env('FILAMENT_LOCK_TIMEOUT', 900),

    /*
    |--------------------------------------------------------------------------
    | Authentication Guard
    |--------------------------------------------------------------------------
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Require Password Verification
    |--------------------------------------------------------------------------
    */

    'password_check' => true,

];
```

---

## Register the Plugin

Inside your Filament Panel Provider:

```php
use Mohamed\FilamentLockScreen\FilamentLockScreenPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentLockScreenPlugin::make(),
        ]);
}
```

---

## How It Works

### Activity Tracking

The plugin continuously tracks authenticated user activity.

When no activity occurs within the configured timeout period:

1. Session becomes locked.
2. Overlay appears immediately.
3. User interaction is blocked.
4. Password verification is required.

### Unlock Process

The user enters their current password.

The plugin validates it using Laravel's hashing system:

```php
Hash::check(
    $password,
    auth()->user()->password
);
```

If valid:

* Session is restored
* Lock state is removed
* User continues working without page reload

---

## Events

### Locked Event

```php
use Mohamed\FilamentLockScreen\Events\Locked;
```

Example:

```php
Event::listen(Locked::class, function (Locked $event) {
    logger()->info(
        'User locked',
        ['user_id' => $event->user->id]
    );
});
```

---

### Unlocked Event

```php
use Mohamed\FilamentLockScreen\Events\Unlocked;
```

Example:

```php
Event::listen(Unlocked::class, function (Unlocked $event) {
    logger()->info(
        'User unlocked',
        ['user_id' => $event->user->id]
    );
});
```

---

## Customizing the View

Publish views:

```bash
php artisan vendor:publish --tag=filament-lock-screen-views
```

Published location:

```text
resources/views/vendor/filament-lock-screen
```

You can fully customize:

* Colors
* Branding
* Logo
* Layout
* Animations
* Typography

---

## Example Environment Variables

```env
FILAMENT_LOCK_TIMEOUT=900
```

### Common Values

| Time       | Seconds |
| ---------- | ------- |
| 5 Minutes  | 300     |
| 10 Minutes | 600     |
| 15 Minutes | 900     |
| 30 Minutes | 1800    |
| 1 Hour     | 3600    |

---

## Security

The plugin:

* Never stores passwords
* Uses Laravel Hash verification
* Uses session-based locking
* Works with Filament authentication
* Prevents unauthorized access to active sessions

---

## Architecture

```text
src/
├── Contracts/
├── Events/
├── Http/
│   └── Middleware/
├── Livewire/
├── FilamentLockScreenPlugin.php
└── FilamentLockScreenServiceProvider.php
```

---

## Roadmap

### Planned Features

* [ ] PIN Unlock Mode
* [ ] Biometric Unlock Support
* [ ] Multi-panel Support
* [ ] User-specific Timeout Settings
* [ ] Role-based Lock Policies
* [ ] Audit Log Integration
* [ ] Browser Activity Detection
* [ ] Dark Mode Optimizations
* [ ] Team Admin Override

---

## Testing

Run tests:

```bash
composer test
```

or

```bash
vendor/bin/phpunit
```

---

## Contributing

Contributions are welcome.

1. Fork the repository
2. Create a feature branch

```bash
git checkout -b feature/my-feature
```

3. Commit your changes

```bash
git commit -m "Add my feature"
```

4. Push to GitHub

```bash
git push origin feature/my-feature
```

5. Open a Pull Request

---

## Changelog

Please see CHANGELOG.md for more information on recent updates.

---

## License

The MIT License (MIT).

---

## Credits

* Laravel
* FilamentPHP
* Livewire

---

## Support

If you discover a bug or have a feature request, please open an issue on GitHub.

GitHub Repository:

https://github.com/mohamedElsayedIbrahim/filament-lock-screen

---

Made with ❤️ for the Filament community.
