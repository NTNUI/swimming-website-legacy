#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <mysql.h>

/* Error codes and error reporting */
#define CONF 0x01 /* error in configuration */
#define ARGS 0x02 /* invalid arguments */
#define CONN 0x04 /* unable to establish connection to MySQL server */
#define QURY 0x08 /* unable to create MySQL query */
#define MEM 0xff  /* failed to allocate enough memory */

void error(int);

struct dbase
{
    char *user;
    char *passwd;
    char *db;
    char *host;
};

struct query
{
    char *q_base;  /* query base */
    char *values;  /* *printf() format for inserting values */
    int n_vals;    /* number of variables affected/needed by query */
    int base_v;    /* base variable for query */
    char *clause;  /* WHERE or ORDER BY clause if needed */
    int n_clause;  /* number of variables to insert in clause */
    int clause_v[] /* which variables to insert in clause */
};

struct config
{
    struct dbase *db;
    struct qrys[]; /* parameters to change/insert by query */
    size_t q_len;  /* current length, in bytes, of query w/o p-vals */
};

/* Configure DB connection and set up query */
int configure(struct config *);
int check_args(int, char **, struct config *, size_t *);
int mk_query(char **, struct config *, size_t, char **);

/* DB operations */
int connect(MYSQL *, struct config *);
int execute(MYSQL *, char *);
int close(MYSQL *);

int main(int argc, char *argv[])
{
    struct config conf;
    MYSQL mysql;

    if (configure(&conf) != 0)
    {
        error(CONF);
        exit(EXIT_FAILURE);
    }

    if (connect(&mysql, &config) != 0)
    {
        error(CONN);
        exit(EXIT_FAILURE);
    }

    if (check_args(argc, argv, &conf, &q_len) != 0)
    {
        error(ARGS);
        exit(EXIT_FAILURE);
    }

    if (mk_query(argv, &conf, q_len, &query) != 0)
    {
        error(QURY);
        exit(EXIT_FAILURE);
    }

    if (execute(&mysql, query) != 0)
    {
        error(EXEC);
    }

    if (close(&mysql) != 0)
    {
        error(CLOS);
        exit(EXIT_FAILURE);
    }
    return 0;
}

int configure(struct config *conf)
{
    conf->db->user = "<REDACTED>";
    conf->db->passwd = "<REDACTED>";
    conf->db->db = "<REDACTED>";
    conf->db->host = "<REDACTED>";

    conf->qrys = {
        {"INSERT INTO PERSON ", "(email,password) values ('%s','%s') ", 2, 0, "", 0, {-1, -1}},
        {"INSERT INTO PERSON ",
         "(email,password,registered) values ('%s','%s','%s') ",
         3,
         0,
         "",
         0,
         {-1, -1, -1}},
        {"UPDATE PERSON SET ",
         "firstname='%s',lastname='%s',dateofbirth='%s',address='%s',"
         "zipcode='%s',language='%s',phonec='%s',phoneh='%s',phonew='%s',"
         "email='%s',password='%s'",
         13,
         2,
         "WHERE email='%s' AND password='%s'",
         2,
         {0, 1}}};

    return 0;
}
