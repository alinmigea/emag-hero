# emag-hero

## The eMag Hero app

### approach

The pattern implemented was the `Producer-Consumer` pattern, or the `Queue` pattern, in which once a message is dispatched after an event, than there should be an ongoing consumer which will consume the message.

### local

Clone the project from GitHub by running `git clone git@github.com:alinmigea/emag-hero.git`.
Go to the project root path and run `composer install`.
Run the program by going to the root path of the project and typing `php ./src/index.php`.

### configs

In order to modify the setup of the `Hero` or `Beast`, proceed to the `players.yaml` file and change the odds.

### make commands

In order to set up the project if docker and docker-compose are installed, then a simple run of `make install` should pull and build the image. With the cli command `make ssh` you can ssh into the container, and from here with the `make unit-tests` the unit tests will run in the container.
By running the command `make run` the project will run locally and the results will be displayed in the cli. Also, if only PHP is installed locally then the project can be tested by running `php ./src/index.php` but only after `composer install`.

### scenarios
 
Hero is the Winner
```text
[INFO] Game is on
[INFO] Current round is: 1
[INFO] Attacking player is: Beast (Strength:75 Health:60)
[INFO] Defending player is: Hero (Strength:76 Health:92)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 17
[INFO] Current round is: 2
[INFO] Attacking player is: Hero (Strength:76 Health:75)
[INFO] Defending player is: Beast (Strength:75 Health:60)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 16
[INFO] Current round is: 3
[INFO] Attacking player is: Beast (Strength:75 Health:44)
[INFO] Defending player is: Hero (Strength:76 Health:75)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 4
[INFO] Attacking player is: Hero (Strength:76 Health:75)
[INFO] Defending player is: Beast (Strength:75 Health:44)
[INFO] Defending player has no escape, Attacking player makes twice the damage
[INFO] Defending player damage is: 64
[INFO] Game is over, Beast died after 4 rounds.
[INFO] Winner is: Hero
[INFO] Game is over
```

Beast is the Winner
```text
[INFO] Game is on
[INFO] Current round is: 1
[INFO] Attacking player is: Beast (Strength:71 Health:76)
[INFO] Defending player is: Hero (Strength:74 Health:66)
[INFO] Defending player has lucky defence, Attacking player makes half the damage
[INFO] Defending player damage is: 2
[INFO] Current round is: 2
[INFO] Attacking player is: Hero (Strength:74 Health:64)
[INFO] Defending player is: Beast (Strength:71 Health:76)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 2
[INFO] Current round is: 3
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:64)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 7
[INFO] Current round is: 4
[INFO] Attacking player is: Hero (Strength:74 Health:57)
[INFO] Defending player is: Beast (Strength:71 Health:74)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 5
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:57)
[INFO] Defending player has lucky defence, Attacking player makes half the damage
[INFO] Defending player damage is: 7
[INFO] Current round is: 6
[INFO] Attacking player is: Hero (Strength:74 Health:50)
[INFO] Defending player is: Beast (Strength:71 Health:74)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 7
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:50)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 21
[INFO] Current round is: 8
[INFO] Attacking player is: Hero (Strength:74 Health:29)
[INFO] Defending player is: Beast (Strength:71 Health:74)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 9
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:29)
[INFO] Defending player avoided the attack, Attacking player makes no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 10
[INFO] Attacking player is: Hero (Strength:74 Health:29)
[INFO] Defending player is: Beast (Strength:71 Health:74)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 11
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:29)
[INFO] Defending player avoided the attack, Attacking player makes no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 12
[INFO] Attacking player is: Hero (Strength:74 Health:29)
[INFO] Defending player is: Beast (Strength:71 Health:74)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 13
[INFO] Attacking player is: Beast (Strength:71 Health:74)
[INFO] Defending player is: Hero (Strength:74 Health:29)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 42
[INFO] Game is over, Hero died after 13 rounds.
[INFO] Winner is: Beast
[INFO] Game is over
```

Max rounds reached
```text
[INFO] Game is on
[INFO] Current round is: 1
[INFO] Attacking player is: Beast (Strength:84 Health:88)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 2
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:88)
[INFO] Defending player is hit, Attacking player makes default damage
[INFO] Defending player damage is: 12
[INFO] Current round is: 3
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 4
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 5
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 6
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 7
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 8
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 9
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 10
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 11
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 12
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 13
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 14
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 15
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 16
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 17
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 18
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 19
[INFO] Attacking player is: Beast (Strength:84 Health:76)
[INFO] Defending player is: Hero (Strength:76 Health:84)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Current round is: 20
[INFO] Attacking player is: Hero (Strength:76 Health:84)
[INFO] Defending player is: Beast (Strength:84 Health:76)
[INFO] Defending player and Attacking player have equal stats, no damage
[INFO] Defending player damage is: 0
[INFO] Game is over, max rounds reached
[INFO] No winner
[INFO] Game is over
```
