# Upgrade Notes

## Migrating from Version 1.x to Version 2.0.0

### Global Changes
- PHP8 return type declarations added: you may have to adjust your extensions accordingly
- ⚠️ Switched to twitter API v2:
  - You need to create a project in twitter backoffice instead of an standalone app (https://developer.twitter.com/en/portal/projects-and-apps)
  - Changed feed configuration: You need to set users ID instead of screen name in feed configuration