# make(1) description file for creating executable programmes needed by
# the 'studord' svommer.
#
# Author (c):   Bård Skaflestad <bardsk@math.ntnu.no>
# Creation:     2002-03-28
# Modified:     2002-05-10, Bård Skaflestad <bardsk@math.ntnu.no>
#
# @(#)$Id:$

# Config
SHELL=  /bin/sh
PATH=   /store/bin:/store/gnu/bin:/bin:/usr/bin:/usr/sbin

BASEDIR=/home/groups/svommer/public_html/
DESTDIR=$(BASEDIR)/admin/bin/
SRCDIR= $(BASEDIR)/admin/src/
JCLS=   DBWrite.class
JSRC=   $(JCLS:.class=.java)

CC=     gcc
CFLAGS= -O2 -s -ansi -pedantic -Wall -W

JAVAC=  javac
JFLAGS= -O -deprecation

INSTALL=install

all:    inst exec_wrapper $(JCLS)

inst:	exec_wrapper $(JCLS)
	$(INSTALL) -s -p --group=svommer --mode=2771 exec_wrapper $(DESTDIR)
	$(INSTALL) -p --group=svommer --mode=660 $(JCLS) $(DESTDIR)
	touch $@ && chmod g+rw $@

exec_wrapper: exec_wrapper.c
	$(CC) $(CFLAGS) -o $@ $<

%.class: %.java
	$(JAVAC) $(JFLAGS) $<
