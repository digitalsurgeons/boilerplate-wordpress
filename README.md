# DS Boilerplate

## Quick start

```bash
npm install
```

Pass your local site url to a bash variable
```bash
site=[site url here] npm run dev
```

Default login to the WP dashboard:  
**admin : boilerplate**

We don't need to tell you to change this but, change this as soon as possible.

## Build Process
Currently the boilerplate uses Webpack 3.x. JS is auto-globbed and does not require manual additions to a app.js file. However, the SCSS is more complicated and doesn't make globbing easy. We hope to change this in the future. Any new JS files require a restart of Webpack's watcher.

## Twig

The new Boilerplate uses Twig as a templating engine through the awesome [Timber plugin](https://github.com/timber/timber) for Wordpress. Currently, each view extends the `_layout.twig` file and contains a content block. An example of how to use this is in the `_page.twig` template. Routing is handled by `if` statements currently (better solutions very welcomed). Check out `index.php` for a rudimentary intro into simple routing. More resources for Timber/Twig can be found here:

- [Twig Documentation](https://twig.symfony.com/doc/2.x/)
- [Timber Docs](https://timber.github.io/docs/)
- [ACF + Timber](https://timber.github.io/docs/guides/acf-cookbook/)

## Advanced Custom Fields
We use ACF extensively on our builds. We have a single Components group that houses our component library.

### 🆕 ACF JSON
We recently started using ACF JSON which, upon save of a field will save a copy of your group in a JSON file in the boilerplate theme directory. These should be tracked in git. For more information on how this work check out the [ACF Docs](https://www.advancedcustomfields.com/resources/local-json/) and [information on syncing](https://www.advancedcustomfields.com/resources/synchronized-json/).


## Front End Style
[Check out our front-end guide](frontendguide.md)
