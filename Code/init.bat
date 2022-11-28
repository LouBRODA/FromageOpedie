@echo off
cls

PATH=%PATH%;C:\Program Files\PostgreSQL\15\bin
cls
set DATABASE_URL=postgres://tncgniwrddfkvg:88d421f583b147bb6d8eaee9cd377b48a16d9c9481c094032c12aa17f968e19b@ec2-34-246-86-78.eu-west-1.compute.amazonaws.com:5432/d6jd8juvb86a3p
cls
heroku psql --app=fromage-opedie