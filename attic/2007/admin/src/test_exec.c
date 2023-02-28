#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>

int
main(void) /*int argc, char *argv[])*/
{
    fprintf(stderr, "test_exec:\n");
    fprintf(stderr, "\t(ruid,euid)=(%ld,%ld)\n",
            (long)getuid(), (long)geteuid());
    fprintf(stderr, "\t(rgid,egid)=(%ld,%ld)\n",
            (long)getgid(), (long)getegid());

    return 0;
}
