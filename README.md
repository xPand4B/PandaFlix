# PandaFlix
Another Netflix clone for in-home streaming.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/PandaFlix>
- **Issue Tracker**: <https://github.com/xPand4B/PandaFlix/issues>
- **Documentation**: <https://github.com/xPand4B/PandaFlix/tree/master/documentation>

## Table of Content
* [Versioning](#versioning)
* [How to use](#how-to-use)


## Versioning
PandaFlix follows the [Semantic Versioning 2.0.0](https://semver.org/).
1. **MAJOR** version when you make incompatible API changes,
2. **MINOR** version when you add functionality in a backwards-compatible manner, and
3. **PATCH** version when you make backwards-compatible bug fixes.

Additional labels for pre-release and build metadata are available as extensions to the **_MAJOR.MINOR.PATCH_** format.


## How to install

### Settings
To setup the application you need a file named `.psh.yaml.override` in your **root directory**.
After you have that go inside the `.psh.yaml`, crap all settings you wanna change and paste them inside the `.psh.yaml.override`.

**IMPORTANT:** You need to keep the original hierarchy!

(e.x. you wanna override a const, there has to be a `const:` at the beginning.)


### Console command
All available console commands _(Production and Development)_ can be found by typing `./psh.phar`.
