# Sylius Article Bundle

This bundle extends the Sylius e-commerce platform with Article resource, which can be used to
publish news, articles, or as a blog. It comes with full multilingual support, the ability to
group articles into categories, and the ability to set related products for articles.

[<img title="Edit Article" src="http://i.imgur.com/Odpgjg6.png" height="170">](http://i.imgur.com/nNT1UGR.png)
[<img title="Article Listing" src="http://i.imgur.com/avl1pls.png" height="170">](http://i.imgur.com/kVjHfIj.png)
[<img title="Single Article" src="http://i.imgur.com/BkTMaBn.png" height="170">](http://i.imgur.com/swCDPI2.png)

---

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
      - { resource: "@WebburzaSyliusArticleBundle/Resources/config/config.yml" }
  ```

  4. register routes in `app/config/routing.yml`

  ```yaml
  webburza_article:
      resource: "@WebburzaSyliusArticleBundle/Resources/config/routing.yml"
  
  webburza_article_front:
      resource: "@WebburzaSyliusArticleBundle/Resources/config/routingFront.yml"
      prefix:  /articles
  ```

  As you can see, there are two groups of routes, the main resource (administration) routes,
  and the front-end routes. If you're using the bundle for a blog, or news, you can
  set the prefix for the routes here, changing it to `/blog`, or `/news`.

  5. The bundle should now be fully integrated, but it still requires
database tables to be created. For this, we recommend using migrations.

  ```bash
  $ bin/console doctrine:migrations:diff
  $ bin/console doctrine:migrations:migrate
  ```
  
  Or if you don't use migrations, you can update the database schema directly.
  
  ```bash
    $ bin/console doctrine:schema:update
  ```

## Configuration

### Translations and naming (blog, news, articles...)

The bundle has multilingual support, and language files can be
overridden as with any other bundle, by creating translation files in the
`app/Resources/WebburzaSyliusArticleBundle/translations` directory.

This also allows for different naming, so if you're using the bundle as a blog,
or as a source of latest news, you can replace all mentions of articles with
that of blog, news, or something else completely.

To get started, check the bundle's main language file in:
[Resources/translations/messages.en.yml](Resources/translations/messages.en.yml)

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
    file_browser:
        browse_url: "/browser/browse.php"
        upload_url: "/uploader/upload.php"
```

This will add file upload and browse controls to your rich-text editors.
For more information, see http://docs.ckeditor.com/#!/guide/dev_file_browse_upload

## License

This bundle is available under the [MIT license](LICENSE).

## To-do

- Automated tests
