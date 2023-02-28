/*
 * exec_wrapper.c  - Wrapper around java(1) executable in order to make
 *                   the latter SGID.  We need SGID access because we do
 *                   not want to expose DB (MySQL) passwords to the
 *                   entire internet.
 *
 * Author (c):  Bård Skaflestad <bardsk@math.ntnu.no>
 * Creation:    2002-02-28
 * Modified:    2002-07-16, Bård Skaflestad <bardsk@math.ntnu.no>
 *
 * @(#)$Id:$
 */
#include <unistd.h>
#include <sys/types.h>

#include <stdio.h>
#include <stdlib.h>


/* Configuration:
 *  - JAVA  : /path/to/java
 *  - CLASS : Name of class to execute
 *  - EXECNM: Process name.  Appears in /proc and ps(1) output
 *  - CP    : Classpath for additional Java classes
 *  - JNPATH: java.library.path for native libraries
 *  - NEXTRAARGS:
 *            Number of extra arguments needed to execute Java class.
 */
#define PROGNM  "/store/bin/java"
#define CLASS   "TestDbAccess"
#define EXECNM  PROGNM
#define CP
"/home/groups/svommer/public_html/admin/bin/mm.mysql-2.0.6.jar:/home/groups/svommer/public_html/admin/bin/"
#define JNPATH  "-Djava.library.path=/home/groups/svommer/public_html/admin/bin/"
#define NEXTRAARGS	4

int
main(int argc, char *argv[])
{
#if 0
    char **ext_argv;    /* Extended argv for exec'ed program */
    int    i;

    ext_argv = malloc((argc + NEXTRAARGS + 1) * sizeof *ext_argv);

    if (ext_argv == (char **)NULL) {
        fprintf(stderr, "Unable to obtain memory for holding program "
                "arguments\n");
        exit(EXIT_FAILURE);
    }

    ext_argv[0] = EXECNM;
    ext_argv[1] = JNPATH;
    ext_argv[2] = "-classpath";
    ext_argv[3] = CP;
    ext_argv[4] = CLASS;

    /* Copy arguments to extended arguments.  No argument parsing in
     * this program.  Leave it all up to the receiving Java program.
     */
    for (i = 1; i < argc; i++) {
        ext_argv[i + NEXTRAARGS] = argv[i];
    }
    ext_argv[argc + NEXTRAARGS] = (char *)NULL;

    fprintf(stderr, "exec_wrapper:\n");
    fprintf(stderr, "\t(ruid,euid)=(%ld,%ld)\n",
            (long)getuid(), (long)geteuid());
    fprintf(stderr, "\t(rgid,egid)=(%ld,%ld)\n",
            (long)getgid(), (long)getegid());

    /* This call should NOT return.  See execv(3) and execve(2) for
     * details.
     */

    return execv(PROGNM, ext_argv);
#endif
    return 0;
}
