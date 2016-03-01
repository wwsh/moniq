Media file naming standards
===========================
This document contains a brief summary of the standard file naming conventions (excerpt from the "PRE+ Media File Naming Standards") used throughout the media software, created by WWSH.

Definitions
-----------
A sound media library consists of these types of elements, called entries:
* **releases** - items spanning multiple single entries (tracks), usually coming from official CD albums, maxi singles and vinyl singles from one performer. All tracks were released in the same moment of time.
* **albums** - items spanning multiple tracks by a single performer, grouped in an album. This container is destined for unofficial albums (not released on music media).
* **artist folders** - collector items containing multiple tracks by a single artist, neither album nor release related, from various years
* **year directory** - items spanning single tracks, released in a given year, or yearspan.

Delimiter is standard dash accompanied by two spaces:

    " - "
A segment is a part of a name. Segments are usually bound to delimiters and also parentheses.

Release item's naming standard
------------------------------
This is the format of a folder on disk media:

    [YEAR]? [ARTIST] - [TITLE] [CAT]?

[YEAR] and [CAT] are optional.
Example of valid release names:

    2014 Tough Love - Dreams
    1989 Ten City - Funny Love (The Knee Deep Mix) [TENSIT10]
    1984 Al Corley - Square Rooms [MSX 76229]
    Candi - Dancing Under A Latin Moon

Artist item's naming standard
-----------------------------
This is the format of a folder on disk media:

    [ARTIST]

The [ARTIST] cannot contain reserved sequences, like delimiters or year indications, catalogue numbers.

Example of valid artist names:

    Eurythmics
    Vengaboys
    The Red Hot Chilli Peppers

Album item's naming standard
----------------------------
This is the format of an album on disk media:

    [ARTIST] - [TITLE]

This standard does not allow year or catalogue number indication.
Example of album names:

    Mr. Zivago - Tell By Your Eyes
    Various Artists - Tojo Rarities Productions

Year directory item's naming standard
-------------------------------------
This is the format of a year container on disk media:

    [YEAR] (- [YEAR])? | [YEAR]+

Example of valid directory names:

    1990 - 1994
    1995+
    2001
    1995 - 1996

File naming standard
--------------------
Files, contained in disk media directories, must adhere to the following format:

    ([INDICATOR] - )[ARTIST] - [TITLE](, [YEAR] [CAT])

[INDICATOR] can be one or two digit, alphanumeric.
Example of valid files:

    01 - Delanua - How Many Fill (Vocal).mp3
    Allen Dee - Inny Miny Miney Moo (Feets Version), 1984 AMD 007b1.mp3
    On TV - Holiday Love Affair (Extended Version).flac

Additional naming standards
---------------------------
Standards for naming directories and files are compatible. Media files additionally can have number indicators, or extended year indications, inherited from older standards (see above).

Let's list an example item, fully compliant to the standards:

    2014 Tvardovsky - Colours
        01 - Tvardovsky - Colours (Original Mix).mp3
        02 - Tvardovsky - Colours (Stas Drive Remix).mp3
        03 - Tvardovsky - Colours (Beat Maniacs Remix).mp3

The first item is directory, the next 3 lines are files on disk media.

**Please note that release directories cannot use file-specific year and catalog indicators and vice versa!**

About
-----
For more extensive information about the media collection standards defined here, please contact us at <contact@wwsh.io> .
