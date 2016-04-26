# Sylius Article Bundle

[![Build Status](https://travis-ci.org/webburza/sylius-article-bundle.svg?branch=master)](https://travis-ci.org/webburza/sylius-article-bundle)

This bundle extends the Sylius e-commerce platform with Article resource, which can be used to publish news, articles, or as a blog.

## Installation

  1. require the bundle with Composer:

  ```bash
    $ composer require webburza/sylius-article-bundle
  ```

  2. enable the bundle in `app/AppKernel.php`:

  ```php
    public function registerBundles()
    {
      $bundles = array(
        // ...
        new \Webburza\Sylius\ArticleBundle\WebburzaSyliusArticleBundle(),
        // ...
      );
    }
  ```

  3. add configuration to the top of `app/config/config.yml`:

  ```yaml
    imports:
        - { resource: @WebburzaSyliusArticleBundle/Resources/config/config.yml }
  ```

  4. register routes in `app/config/routing.yml`

  ```yaml
    webburza_sylius_article_bundle:
        resource: "@WebburzaSyliusArticleBundle/Resources/config/routing.yml"
  ```

  5. The bundle should now be fully integrated, but it still requires
database tables to be created and RBAC permissions set. To ease this
process, after you've integrated the bundle you can run the
following command:

  ```bash
  $ app/console webburza:sylius-article-bundle:install
  ```

  This will create all the required database tables, prefixed with `webburza_`,
and all the RBAC permissions, under the existing 'content' node.

## Configuration

### Translations and naming (blog, news, articles...)

The bundle is has multilingual support, and language files can be
overridden as with any other bundle, by creating translation files in the
`app/Resources/WebburzaSyliusArticleBundle/translations` directory.

This also allows for different naming, so if you're using the bundle as a blog,
or as a source of latest news, you can replace all mentions of articles with
that of blog, news, or something else completely.

To get started, check the bundle's main language file in:
[Resources/translations/messages.en.yml](https://github.com/webburza/sylius-article-bundle/Resources/translations/messages.en.yml)

### Routes

By default, the bundle adds three new front-end routes:

- /articles/
- /articles/my-first-article/
- /articles/category/my-first-category/

If you've decided to use the bundle as a blog, you'll probably want to
have the routes prefixed by `blog`, not `articles`, as is by default.
To accomplish this, add the bundle's configuration block to your
`app/config/config.yml` file.

```yaml
# ...

webburza_sylius_article:
    slug: articles
    file_browser:
        browse_url: ""
        upload_url: ""
```

Here you can change the `slug` property to anything you choose, i.e. blog.
This will result in the following front-end routes.

- /blog/
- /blog/my-first-article/
- /blog/category/my-first-category/

### File repository integration in rich-text editors

The bundle uses rich-text editors ([CKEditor](http://ckeditor.com/)) to work
with content, which allows the user to work with images in the content as well.

By default, this is limited to specifying the URL to the image manually, but
if your application integrates a file repository system for editors, such as
[CKFinder](https://cksource.com/ckfinder), or the free alternative
[KCFinder](http://kcfinder.sunhater.com/), you can easily add the functionality
to allow the users to upload and work with image files directly trough the
rich-text editor.

To accomplish this, simply fill in the bundle's configuration with your file browser
URI's, as seen in the example bellow:

```yaml
# ...

webburza_sylius_article:
    slug: articles
    file_browser:
        browse_url: "/browser/browse.php"
        upload_url: "/uploader/upload.php"
```

This will add file upload and browse controls to your rich-text editors.
For more information, see http://docs.ckeditor.com/#!/guide/dev_file_browse_upload

## License

This bundle is available under the [MIT license](LICENSE).

## Contributing

TODO
