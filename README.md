# MONIQ scanner
An example disk media scanner, compatible with file naming standards, described in the docs/.

## Version
Current version: 1.0.

This demo version scans given path for files, creates a collection and dumps all sorted data to mongo. And that's just it.

## Requirements
1. A media file collection compatible with the standards (@see [here](doc/SPECS.md)).
2. A mongoDB service running on default port (configurable in config.yml)

## Installation
1. git clone
2. composer install

## Launching
Example test run on virtual filesystem:

    php bin/console moniq:scan --filesystem=vfs --definition=src/AppBundle/Resources/vfs/example.json /music

Output:

    Starting multimedia scanner...
    Browsing path /music...
    Processing directory 1993 Haddaway - What Is Love (Remixes)
    R: 1993 Haddaway - What Is Love (Remixes)
    R: 1 - Haddaway - What Is Love (7'' Mix).wav
    R: 2 - Haddaway - What Is Love (Eat This Mix).wav
    R: 3 - Haddaway - What Is Love (Tour De Trance Mix).wav
    Processing directory 1985 Paul Hardcastle - 19 (The Final Story) [601 814]
    R: 1985 Paul Hardcastle - 19 (The Final Story) [601 814]
    R: 01 - Paul Hardcastle - 19 (The Final Story).wav
    R: 02 - Paul Hardcastle - 19 (Destruction Mix).wav

Example run against real media collection:

    php bin/console moniq:scan /media/jack/1TB/music

## Media directory and file naming standards
For more information on this topic, refer to the [docs](doc/SPECS.md) or contact me directly at <contact@wwsh.io> .

## Internals

### Development
You will need phpunit installed in your system. Run the supplied tests to learn about crucial modules and services.

Check out the **spec** folder to learn about the designed class responsibilities.

Implementation should be SOLID.

### Testing
Each module and service can be easily decoupled thanks to 100% dependency conrol.
It is very convenient to use the built-in VFS for debugging and testing purposes.

### TODO
1. Updating entry data in the storage. Currently there is no support for anything else than just adding to mongo.
2. Support for samplers. Some code is already there but has not been tested.
3. Support for the genre parameter. Stored collections should be tagged by it. Genre should be specified by the user on input.
3. Rotate command to create random playlist rotations using given criteria.