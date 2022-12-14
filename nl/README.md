# README #

Here is a short description of this theme and how it should be set-up.

### Table of contents ###

* Requirements
* Installation
* Development
* Production
* Assumptions
* Samples
* Pull requests
* Branches
* Commit guidelines

### Requirements ###

1. Install Yarn on your machine <https://yarnpkg.com/en/docs/install>
2. Install composer (globally) on your machine, this can be done using Yarn `sudo yarn global add getcomposer`

### Installation ###

1. Clone this repository to your machine
2. Change the `name` parameter in the `package.json` to the name of your theme
3. If you want to start developing change the `config.devUrl` parameter in the `package.json` to your development domain name
4. Cd to your `project root`
5. Run `yarn install && composer install`

### Development ###

Run the `yarn start` command from the __project root__ in your terminal to start up the project and it's compilers.

### Build ###

Run the `yarn build` command from the __project root__ in your terminal to build the project.

### Assumptions ###

#### Theme ####

* Frontend components are in `package.json` and are not synced in the repository
* Source assets are located in:
    - Fonts are located in `/assets/fonts/`
    - Images are located in `/assets/images/`
    - Javascript is located in `/assets/scripts/`
    - Style is located in `/assets/styles/`
* Distribution assets are minified and located in:
    - Fonts are located in `/dist/fonts/`
    - Images are located in `/dist/images/`
    - Javascript is located in `/dist/scripts/`
    - Style is located in `/dist/styles/`
* Components are located in `/components/` and always have their own `.js` and `.scss` file

#### Linting ####

We enforce code quality using eslint and stylelint. This means you will see errors during development when linting presets are not passed. Most of the errors can be fixed instand when you run one of the commands below:

```
yarn run lint
yarn run lint:scripts
yarn run lint:styles
```

#### WordPress ####

* WordPress as a composer package deployed in `/wp/`
* Custom content directory in `/wp-content/` (cleaner, and also because it can't be in `/wp/`)
* Local config settings are in `wp-config-local.php` (see samples below)
* Plugins are in `composer.json` and are not synced in the repository

### Samples ###

#### wp-config-local.php ####

```
#!php

<?php

// ** URL settings ** //
define( 'WP_ROOT_URL', '{{ domain }}' );
define( 'WP_HOME', '{{ domain }}' );
define( 'WP_SITEURL', '{{ domain }}/wp' );

// ** MySQL settings - You can get this info from your web host ** //
define( 'DB_HOST', '{{ databaseHostname }}' );
define( 'DB_NAME', '{{ databaseName }}' );
define( 'DB_USER', '{{ databaseUsername }}' );
define( 'DB_PASSWORD', '{{ databasePassword }}' );

// ** Enable development tools ** //
define( 'WP_DEBUG', {{ debug }} ); // Can be true or false
```

### Pull requests ###

While developing only pull request to the `test` branch are accepted. Solving a bugfix, feature or hotfix use the branching structure as stated below.
Commits in the pull request need to follow the commit guidelines.

### Branches ###

All branch names should be written in correct English. The use of abbreviations is not allowed as this can be confusing to developers who are not well known with a project.

#### 1. master ####

We consider `origin/master` to be the main branch where the source code of HEAD always reflects a production-ready state.

#### 2. accept ####

The `origin/accept` branch will contain the latest major release from the `test` branch. The acceptance branch is used for intensive testing. After acceptance of the testing team the branch is merged in the `master` branch. (This branch is mainly used on repositories which are in production, during the initial development this branch is skipped.)

#### 3. test ####

We consider `origin/test` to be the main branch where the source code of HEAD always reflects a state with the latest delivered development changes for the next release.
Must merge back into `accept` for production servers or `master` for development servers.

#### 4. hotfix-* ####

The `hotfix-*` branches are very much like feature branches in that they are also meant to prepare for a new production feature, albeit unplanned.
Must merge back into `test`, `accept` and `master`

#### 5. bugfix-* ####

The `bugfix-*` branches are used to solve non urgent bugs for an upcoming or distant future release.
[!!!] For urgent bugs use the `hotfix` branches.
Must merge back into `test`

#### 6. feature-* ####

The `feature-*` branches are used to develop new features for the upcoming or a distant future release.
Must merge back into `test`

### Commit guidelines ###

#### 1. Language ####

All commit messages should be written in correct English. The use of abbreviations is not allowed as this can be confusing to developers who are not well known with a project.

#### 2. Structure of a commit message ####

The commit message determines the nature of your commit. Based on the message it
should be clear what the change is. Especially the subject of the message should
be short and clear. The subject is matched against a regular expression for
validation:

`^(\[!!!\])?\[(CONFIG|FEATURE|TASK|BUGFIX|CLEANUP|MERGE)\]\ [A-Z]`

This means that a commit message must start with a **tag** (sometimes more),
followed by a **space** and a short **description** which should start with an
uppercase letter. There are a couple predefined keywords which can be used as
tag, surrounded by brackets:

* `[CONFIG]`
* `[FEATURE]`
* `[BUGFIX]`
* `[CLEANUP]`
* `[TASK]`
* `[MERGE]`

Besides these there is a special tag which can be used in *addition* to the previous mentioned tags:

* `[!!!]`

Prefixing your change with this tag, will mark it as being breaking. In case you add a breaking change, add proper description and describe what may break and why. This way you will let other developers know what to expect.

All lines should be limited to 80 characters. [#]_ When adding a detailed description don't continue inside the summary, but start a new sentence.

#### 3. Tags ####

When choosing a tag, you can use the following guidelines.

`[CONFIG]` When a change is mainly a configuration change. For example change credentials of the database, or configure an extension.

`[FEATURE]` When implementing a new feature, like a new extension, or new functionality. This can also apply to new CSS or new styling.

`[BUGFIX]` When you changed code to fix a bug. This can also be a change in CSS.

`[CLEANUP]` When cleaning up the project, like removing temporary files, removing obsolete code, modifying the .gitignore, etc.

`[TASK]` Other issues which do not fit in the previous mentioned tags. Updating an extension is an example of a task.

`[MERGE]` A merge commit can only contain a merge of a feature to the development branch or the merge of the development branch to the master branch when going to production. No other changes should be part of a merge.

`[!!!]` Breaking change. Use this when after this change manual changes should be applied like database changes or when an API is modified which might influence other parts. This tag should be placed in front of other tags, never by itself.

#### 4. Integration ####

When referring to a ticket, enter the following at the end of the commit message. Preceded by an empty line.
Resolves #12345
In which a # is a reference to the ticket ID. Currently only tickets within BitBucket are directly connected to commit messages. Meaning, when you add this below your commit description your ticket will be marked as resolved automatically.

#### 5. Examples ####

`[BUGFIX]` Fixed date format bug
*A bug where the date was displayed in an incorrect format.*
*Resolves: #12334*

`[FEATURE]` Change service level API for feature X
*Feature X has been implemented for the service level API.*

`[TASK]` Updated extension X
*Updated extension X from version 1.4 to 1.5.1*

`[CLEANUP]` Removed unused extension Y
*Removed extension Y, is it is obsolete.*

`[MERGE]` Merged X onto Y

`[!!!][FEATURE]` Change service level API for feature X
*Feature X has been implemented for the service level API.*
*Can breakdown API dependencies*
