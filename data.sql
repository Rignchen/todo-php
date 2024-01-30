create table if not exists `task` (
    `id` integer not null primary key autoincrement,
    `title` varchar(100) not null
);
/*
create table if not exists `user` (
    `id` integer not null primary key autoincrement,
    `phpsessid` varchar(100) not null
);
create table if not exists `user_task` (
    `task_id` integer not null,
    `user_id` integer not null,

    foreign key (`task_id`) references `task` (`id`),
    foreign key (`user_id`) references `user` (`id`)
);
*/
