create table any_payments_billing
(
    id                 int auto_increment
        primary key,
    transaction_id     varchar(255) null,
    paid               tinyint(1)   null,
    user_id            int          null,
    psp_transaction_id text         null,
    amount             float        null,
    currency           text         null,
    psp_class          text         null
);
create table any_payments_logger
(
    id      int auto_increment
        primary key,
    psp_class   text null,
    input   tinyint(1) DEFAULT 0 null,
    output  tinyint(1) default 0 null,
    headers text null,
    fields  text null
)