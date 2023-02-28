#include <stdio.h>
#include <stdlib.h>

int
main(int argc, char *argv[])
{
    int i;
    FILE *fp = fopen("/local/www.studorg/svommer/show_args.log", "a");

    if (!fp) {
        fprintf(stderr, "Unable to open show_args.log\n");
        return EXIT_FAILURE;
    }

    for (i = 0; i < argc; i++)
        fprintf(fp, "argv[%d] = %s\n", i, argv[i]);

    return EXIT_SUCCESS;
}
