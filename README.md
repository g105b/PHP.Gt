# Rapid development engine.

<img align="right" src="https://raw.githubusercontent.com/phpgt/webengine/master/logo.png" alt="PHP.Gt logo" />

Welcome to PHP.Gt webengine — an application development toolkit aimed at streamlining development and respecting web technologies.

Web frameworks offer many features, but often come with steep learning curves or imposing rules. The motivation behind this project is the belief that what a framework can offer can be achieved by **eliminating code rather than adding more**.

[Head over to the Github Wiki for documentation](https://github.com/phpgt/webengine/wiki).

***

<a href="https://circleci.com/gh/phpgt/webengine" target="_blank">
    <img src="https://badge.status.php.gt/webengine-build.svg" alt="PHP.Gt build status" />
</a>
<a href="https://coveralls.io/r/phpgt/webengine" target="_blank">
    <img src="https://badge.status.php.gt/webengine-coverage.svg" alt="PHP.Gt code coverage" />
</a>
<a href="https://scrutinizer-ci.com/g/phpgt/webengine" target="_blank">
    <img src="https://badge.status.php.gt/webengine-quality.svg" alt="PHP.Gt code quality" />
</a>
<a href="https://packagist.org/packages/phpgt/webengine" target="_blank">
    <img src="https://badge.status.php.gt/webengine-version.svg" alt="PHP.Gt Composer version" />
</a>
<a href="https://packagist.org/packages/phpgt/webengine" target="_blank">
    <img src="http://img.shields.io/packagist/dm/phpgt/webengine.svg?style=flat-square" alt="PHP.Gt download stats" />
</a>
<a href="http://www.php.gt" target="_blank">
    <img src="https://badge.status.php.gt/webengine-docs.svg" alt="PHP.Gt Website" />
</a>

Features at a glance
--------------------

+ Simple routing: A page's view in `page.html` has optional logic separated within `page.php`  
+ Pages made dynamic via server-side DOM Document access
+ HTML templates
+ Database organisation
+ Create web pages or web services (APIs) with the same code
+ Inbuilt client side script building (SCSS, ES6, etc.)
+ Web security as standard
+ Strong separation of concerns over PHP, HTML, SQL, JavaScript, CSS
+ Preconfigured PHPUnit and Behat test environment
+ Workflow tools to quickly create, integrate and deploy projects

Essential concepts
------------------

### Static first

To increase development speed and lower the barrier to getting an idea prototyped, the technique of developing a static prototype first is promoted, dropping in logic when and where necessary to turn prototypes into fully functional production code with as few steps as possible.  

### Build using tech you already know

The main idea is to provide a platform where you can get as much done, using standard tech you've already learnt. Technologies that make up the [world wide web](https://en.wikipedia.org/wiki/World_Wide_Web), such as HTML and HTTP, are respected and enhanced by bringing useful tools and techniques to you, the developer.

### Drop in tools without any fuss

There are a lot of useful tools included as standard, such as [SCSS parsing](https://github.com/phpgt/webengine/wiki/Client-side-files), [HTML templating](https://github.com/phpgt/webengine/wiki/Templating) and [CSRF handling](https://github.com/phpgt/webengine/wiki/CSRF), but the highly modularised architecture keeps compatibility high. Packages from [Packagist](https://packagist.org) can be installed and loaded with zero configuration.

### Develop locally or virtually

Preconfigured scripts are available to automatically set up local servers or virtualisation environments to get you going as quickly as possible, without having to change existing computer configuration.

### Community of blueprints

To get projects going with full momentum, blueprint projects are available to base your projects off. Blueprints come with just enough level of design and functionality to get a prototype out the door as quickly as possible, without prescribing anything.

Getting started
---------------

### Getting started developing WebEngine applications

If you are new to WebEngine development, check out the [Quick Start][quick-start] guide in the documentation, or jump straight into [the tutorials][tutorials].

### Getting started contributing to WebEngine

If you are looking to contribute to WebEngine itself, please read the [Contribution guidelines document][contributing].

How to get help
---------------

### Submit an issue

The [Github issue tracker][issues] is used to submit bug reports, feature requests or certain types of technical support requests. If you think something is not working correctly, or the documentation doesn't cover your issue, feel free to open a new issue, describing what you have tried, what you expect, and what went wrong.

### Ask on Stack Overflow

If you have more of a "How do I do _X_ in WebEngine?" question, it is preferred to ask this publically on Stack Overflow. If you [tag your question with `phpgt-webengine`][stack-overflow], or the area of PHP.Gt that the question referrs to, a WebEngine contributor will answer your question as soon as possible.

[quick-start]: https://github.com/PhpGt/WebEngine/wiki/Quick-start
[tutorials]: https://github.com/PhpGt/WebEngine/wiki/hello-world-tutorial
[contributing]: https://github.com/PhpGt/WebEngine/blob/master/CONTRIBUTING.md
[issues]: https://github.com/PhpGt/WebEngine/issues
[stack-overflow]: https://stackoverflow.com/questions/tagged/phpgt-webengine
