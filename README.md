# Webfat - Frdlweb CMS made easy!
Webfat is build on top of the Frdlweb Framework.

**Its current status is ALPHA.**

# Multihost/Multisite Markdown Hub for Frdlweb CMS
Place content files for `example.com` into `userdata/sites/example.com` as in the example code.

# Special!
There is a *special* as part of webfat: [Inline Webmaker](https://github.com/frdlweb/webfat/blob/main/public/content/pages/webfat-specials/inline-webmaker.md)

## Installation
* Set your webserver/webhost www-directory to the `public` directory

## ToDo...
* webfat console
* module
* ...

# Features Paradigma
Webfat will provide some special specs. implementations.

# Runtime compilation
spec: [1.3.6.1.4.1.37553.8.1.8.1.575874](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.575874)

ID: [weid:1-8-1-CCCI-5](https://registry.frdl.de/?goto=weid%3A1-8-1-CCCI-5)

*/ISO/Identified-Organization/6/1/4/1/Frdlweb/weid/1/8/1/NoVersion*

Instead of installing a packaged version, we compile a composition of components on a per instance base. The installation may not be portable to another machine.

# Frdlweb CTA Storage
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606)

ID: [weid:1-8-1-CTA-1](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1)

Package: [frdl/cta](https://github.com/frdl/cta)

Save data/files based on a content hash. Same data will only be saved once, saving disk space.

# XHash
##### - Hashing algo is based on the checksum and content size (2keys)
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606.1.56234465](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606.1.56234465)

ID: [weid:1-8-1-CTA-1-XHASH-3](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1-XHASH-3)

Package: [frdl/cta](https://github.com/frdl/cta)

To reduce the possibility of collisions we store the hash along with the content-size.

##### - The CTA is payload is chunked by chunks of the same size
spec: [1.3.6.1.4.1.37553.8.1.8.1.16606.1.27200801029](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.16606.1.27200801029)

ID: [weid:1-8-1-CTA-1-CHUNKED-4](https://registry.frdl.de/?goto=weid%3A1-8-1-CTA-1-CHUNKED-4)

Package: [frdl/cta](https://github.com/frdl/cta)

Files/content is saved into chunks of the same size/length.

# Central Codebae - Client
spec: [1.3.6.1.4.1.37553.8.1.8.1.984.17868.761724857](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.984.17868.761724857)

ID: [weid:1-8-1-RC-DSC-CLIENT-0](https://registry.frdl.de/?goto=weid%3A1-8-1-RC-DSC-CLIENT-0)

Package [frdl/remote-psr4](https://github.com/frdl/remote-psr4)

Load code from an API "on the fly" when needed.

# No Code - Config only
spec: [1.3.6.1.4.1.37553.8.1.8.1.1089085](https://registry.frdl.de/?goto=oid%3A1.3.6.1.4.1.37553.8.1.8.1.1089085)

ID: [weid:1-8-1-NCCD-3](https://registry.frdl.de/?goto=weid%3A1-8-1-NCCD-3)

Compliant to User Data Manifesto 2.0 and considering security issues, we store ONLY DATA on the userlevel (e.g. html, xml, json, md, ...) NOT bound to any implementation code.
Compliant to Config-Only-API (?) and compliant to User Data Manifesto 2.0 and considering security issues, we  allow/request/expect any modification on the instance level (e.g. theme, sitesettings, plugins and modules) ONLY BY API/INTERFACE.
The instance level is meant to be any "installation" or instance of the NCCD Software (CMS, API, ...), this is where  we do NOT DO HAVE ANY CODE ISSUES: This is deligated to the scope of the SaaS-Codebase-Provider and could be done via local shares or remote shares of source code.
