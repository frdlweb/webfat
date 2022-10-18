# Webfat - Frdlweb CMS made easy!
[Webfat](https://webf.at/) is build on top of the Frdlweb Framework, made by [Webfan Homepagesystem](https://webfan.de/index.html).

# **Its current status is ALPHA.**
The code will change in future!

# Installation
* Set your webserver/webhost www-directory to the `public` directory
* You can go with the step by step guidance as this project grows by just [downloading ONE file](https://raw.githubusercontent.com/frdlweb/webfat/main/public/index.php).

## Multihost/Multisite Markdown Hub for Frdlweb CMS
Place content files for `example.com` into `userdata/sites/example.com` as in the example code.

## Building Flavors and Configurations
°   | Enduser | Webmaster | Developer
--- |--- | --- | ---
**Audience** - Who can use `Webfat`? | A `Enduser` of an Webfat instance with WebfatHub, or someone using Webfat App/Browser. | A `Webmaster` can run Webfat on his own host or webhosting, he can use and configurate his instance without handling any source code. *This is the recommended Flavor** for the beginning so far.  | The `Developer` want to alter the source code and write his own module and implementations. 
Building Flavor |   | Webmaster **[DEFAULT]** | Developer
Webmaster and Developer can select one of two kinds of "Building Flavor" the instance should prefer. This must be done in the `.env`file or in `.webfan.env` or in `.webfat.env`. ***This option influences if you are `Webmaster` or `Developer`!!!*** | *The Enduser **cannot** set environment variables.*  | Get the best Code without to be a programmer using the [No Code Paradigma](https://github.com/frdlweb/webfat/main/README.md#no-code---config-only) *This option influences how Webfat compiles the application!* If this enviroment variable is not set, it will be set to this value! | Develop and compile the core and your custom modules on your own machine using [Runtime Compilation](https://github.com/frdlweb/webfat/main/README.md#runtime-compilation) *This option influences how Webfat compiles the application!* **You have to set this manually!**
`env` Environment Variable "FRDL_BUILD_FLAVOR" |  | ````FRDL_BUILD_FLAVOR = '1.3.6.1.4.1.37553.8.1.8.1.1089085'```` | ````FRDL_BUILD_FLAVOR = '1.3.6.1.4.1.37553.8.1.8.1.575874'````


## Special!
There is a *special* as part of webfat: [Inline Webmaker](https://github.com/frdlweb/webfat/blob/main/public/content/pages/webfat-specials/inline-webmaker.md)


# Features Paradigma
Webfat will provide some special specs. implementations.

## Runtime compilation
spec: [1.3.6.1.4.1.37553.8.1.8.1.575874](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.575874)

ID: [weid:1-8-1-CCCI-5](https://registry.frdl.de/?goto=weid%3A1-8-1-CCCI-5)

*/ISO/Identified-Organization/6/1/4/1/Frdlweb/weid/1/8/1/NoVersion*

Instead of installing a packaged version, we compile a composition of components on a per instance base. The installation may not be portable to another machine.

## Frdlweb CTA Storage
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606)

ID: [weid:1-8-1-CTA-1](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1)

Package: [frdl/cta](https://github.com/frdl/cta)

Save data/files based on a content hash. Same data will only be saved once, saving disk space.

# XHash
###### - Hashing algo is based on the checksum and content size (2keys)
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606.1.56234465](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606.1.56234465)

ID: [weid:1-8-1-CTA-1-XHASH-3](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1-XHASH-3)

Package: [frdl/cta](https://github.com/frdl/cta)

To reduce the possibility of collisions we store the hash along with the content-size.

###### - The CTA is payload is chunked by chunks of the same size
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606.1.27200801029](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606.1.27200801029)

ID: [weid:1-8-1-CTA-1-CHUNKED-4](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1-CHUNKED-4)

Package: [frdl/cta](https://github.com/frdl/cta)

Files/content is saved into chunks of the same size/length.

## Central Codebase - Client
spec: [1.3.6.1.4.1.37553.8.1.8.1.984.17868.761724857](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.984.17868.761724857)

ID: [weid:1-8-1-RC-DSC-CLIENT-0](https://registry.frdl.de/?goto=weid%3A1-8-1-RC-DSC-CLIENT-0)

Package [frdl/remote-psr4](https://github.com/frdl/remote-psr4)

Load code from an API "on the fly" when needed.

## No Code - Config only
spec: [1.3.6.1.4.1.37553.8.1.8.1.1089085](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.1089085)

ID: [weid:1-8-1-NCCD-3](https://registry.frdl.de/?goto=weid%3A1-8-1-NCCD-3)

Compliant to User Data Manifesto 2.0 and considering security issues, we store ONLY DATA on the userlevel (e.g. html, xml, json, md, ...) NOT bound to any implementation code.
Compliant to Config-Only-API (?) and compliant to User Data Manifesto 2.0 and considering security issues, we  allow/request/expect any modification on the instance level (e.g. theme, sitesettings, plugins and modules) ONLY BY API/INTERFACE.
The instance level is meant to be any "installation" or instance of the NCCD Software (CMS, API, ...), this is where  we do NOT DO HAVE ANY CODE ISSUES: This is deligated to the scope of the SaaS-Codebase-Provider and could be done via local shares or remote shares of source code.

## Twelve Factor Application

spec: [1.3.6.1.4.1.37553.8.1.8.1.83642115915](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.83642115915)

ID: [weid:1-8-1-12FACTOR-7](https://registry.frdl.de/?goto=weid%3A1-8-1-12FACTOR-7)

If however possible, Webfat follows the [Twelve Factor Application Development Paradigma](https://12factor.net/).

* I. Codebase
One codebase tracked in revision control, many deploys
* II. Dependencies
Explicitly declare and isolate dependencies
* III. Config
Store config in the environment
* IV. Backing services
Treat backing services as attached resources
* V. Build, release, run
Strictly separate build and run stages
* VI. Processes
Execute the app as one or more stateless processes
* VII. Port binding
Export services via port binding
* VIII. Concurrency
Scale out via the process model
* IX. Disposability
Maximize robustness with fast startup and graceful shutdown
* X. Dev/prod parity
Keep development, staging, and production as similar as possible
* XI. Logs
Treat logs as event streams
* XII. Admin processes
Run admin/management tasks as one-off processes
