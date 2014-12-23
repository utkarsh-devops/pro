=== Plugin Name ===
Contributors: nathancarnes
Tags: domains, mirroring, domain
Requires at least: 3.0
Tested up to: 3.2.3
Stable tag: 1.0

Allows multiple domains to be pointed at a single WordPress install with customization for each.

== Description ==

* Point multiple domains/sub-domains at a single WordPress installation and maintain link integrity (i.e. if you're on http://foo.com, links will be http://foo.com/bar, and if you're http://baz.com links will be http://baz.com/bar)
* Overwrite site title, description, or theme per domain
* Customize content per domain using the [MultiDomain\_if] and [MultiDomain\_else] shortcodes

If you need more customization between domains, WordPress MU is a better option.

== Installation ==

1. Unzip and upload to your plugins directory, or install from admin
2. Activate
3. Edit config.php to your liking using the admin Plugin Editor or your favorite FTP program
4. Profit!

== Configuration Examples ==

Note that you usually won't need to configure your primary domain -- MultiDomain will automatically fall back to your WordPress defaults if not configuration is present for a domain.

= Basic =

In config.php:

    <?php
      $domains = array(
        array(
          'domain' => 'myalternatedomain.com',
          'siteurl' => 'http://myalternatedomain.com',
          'home' => 'http://myalternatedomain.com'
        )
      );
    ?>

= More Complex =

In config.php:

    <?php
      $domains = array(
        array(
          'domain' => 'example1.com',
          'siteurl' => 'http://example1.com',
          'home' => 'http://example1.com'
        ),
        array(
          'domain' => 'example2.com',
          'siteurl' => 'http://example2.com',
          'home' => 'http://example2.com',
          'blogname' => 'Example 2'
        ),
        array(
          'domain' => 'example3.com',
          'siteurl' => 'http://example3.com',
          'home' => 'http://example3.com',
          'template' => 'twentyten',
          'blogname' => 'I have a different name...',
          'blogdescription' => '..and description'
        )
      );
    ?>

== Tag Usage ===

The provided short codes let you tailor your content per domain if needed. [MultiDomain\_else] and [MultiDomain\_default] are identical.

    [MultiDomain_if domain="example1.com"]
      Content only people visiting on example1.com will see.
    [/MultiDomain_if]

    [MultiDomain_else]
      Content anyone visiting on any other domain will see.
    [/MultiDomain_else]

    Normal content everyone will see.
