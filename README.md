## Repo Roadmap

Fork of [USF-CIS-4935/password_manager](https://github.com/USF-CIS-4935/password_manager) intended to focus on individual improvements to code quality and usability

### Styling
- CSS made mobile-compatible
- Move away from \<fieldset\> formatting.
- Reformat password re-user results (move to a modal)
- Re-style buttons to be less ugly
- Add separation between navigation and page content

### Code Quality
- Addition of unit tests
- Full documentation of JS components
- Full documentation of PHP components
- CSS rewritten to use SASS + CSS framework [Bulma](https://bulma.io/)
- Move on-page JS to external files
- Modularization of JS functions

### Functionality
- Dark mode option
- Allow custom entropy source(s) for password generation
- "Password Re-Use" will allow you to select a password card to check
- Allow for "re-use" check from a button on the password card

### Architecture
- Upgrade to Laravel 8.X
- Move Models into dedicated "Models" directory
- Tie styling and JS into [Laravel Mix](https://laravel.com/docs/7.x/mix)
- Encryption of all database content (?)

### Small Fix To-Do List
- "Get Started" on blank password database page
- "Copied to clipboard" message
- Move encryption libs to their own directory
