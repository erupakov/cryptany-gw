# Cryptany gateway

This is a prototype of Cryptany system gateway that handles all interactions with blockchains.

## Releases

### First version (v1)

First internal and debugged release. Used for pre-ICO technology demonstration.

Features:
* Uses BlockCypher.com for blockchain interactions
* Uses SQLite database for storage
* Provides only 1 wallet address method generation, used with Payment button, Chat, Mobile app, Magento payment plugin
* Returns transaction status, sends standard workflow emails
* Tested and approved on 05 Oct 2017

### Second release (v2)

Upgraded and debugged different workflows for different payment endpoints.

Features:
* MySQL database support
* 3 different workflows defined: Payment button, Mobile app, Magento plugin
