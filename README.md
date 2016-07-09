# Attention

This project is going to rebuild afterwards the new [jp-wargaming-api-reader](https://github.com/JohnnyDevNull/jp-wargaming-api-reader) is finished. Then this project will become a more global scope of the Wargaming.NET games. That means, that a game switcher will be implemented.

# Project World of Tanks Statistics Engine

### Description

This is a World of Tanks Player, Clans and Tankopedia Search Engine. It uses Twitter Bootstrap version 3 and some basic JQuery libriaries for a modern user expirience. My main goal with this project is to improve a standardized flat solution which can be simply customized with your own needs, wishes and look & feel.

### Licence

This project ist licenced under the **MIT License**. For more detail see [LICENSE.md](https://github.com/JohnnyDevNull/wot-stats-search-engine/blob/master/LICENSE.md "LICENSE.md")

### Features

##### Pages
- Full text searching for players and whatching the statistics profiles from the search list. **- finished**
- Full text searching for clans and whatching the statistics of the whole clan and it's members. **- finished**
- Include Tankopedia to watch around the tanks and modules for them. **- removed**
- Player rankings **- not finished**
- Clan rankings **- not finished**

##### The Software
- Based on a simple MVC structure developed by myself, to give you a simple way to customize it
- All view relevant html data are outsourced in templates which contains only pure html for better customizing
- config.php for presetting your own features
- language translation with .ini files
- included at the time "en-GB" and "de-DE" for all finished pages

### Installation

You will be able to only include the main **index.php** file, set your necessary settings in the **config.php** and that will be all. From any subfolder in your Project or Homepage

### Plans for later

- Making a joomla Module to get this work on the newest Joomla CMS v3, but it will takes some time, because they have the old twitter bootstrap v2 included which will be in conflict with my included v3.
