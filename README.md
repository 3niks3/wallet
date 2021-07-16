# Virtual Wallet

## Task description
1. As a User, I can sign up for a User account, so that I can access the application.
    - there is registration page when user could be registered
2. As a User, I can log in to my account.
    - there is login page where user could log into his account
3. As a User, I can log out of my account.
    - Login users can log out form profile
4. As a User, I can create a virtual Wallet.
    - user can create multiple virtual wallets (each wallet should have unique name from other user wallets)
5. As a User, I can view a list of my virtual Wallet.
    - There is display list of uer virtual wallets
6. As a User, I can rename my virtual Wallet.
    - user can edit virtual wallet information (rename wallet, name should be unique for other user wallets )
7. As a User, I can delete a virtual Wallet.
    - User can delete wallet
    - Wallet will be deleted together with wallet assigned transactions
8. As a User, I can add a Transaction to a virtual Wallet.
    - user can add transactions (incoming, outgoing)
    - restriction set maximum transfer amount to 5000
    - outgoing transfer amount can exceed total amount in wallet (if user in wallet have 100 then maximum amount for out going transfer will be 100)
    - Previous restriction are to prevent wallet to go in negative values
9. As a User, I can see all the Transactions in my virtual Wallet.
    - there will be list of user registered transactions
10. As a User, I can delete Transaction from a virtual Wallet.
    - user can delete ONLY last transaction
    - this restriction are made to prevent wallet to go in negative values
11. As a User, I can mark Transaction as Fraudulent.
    - User can mark transaction as Fraud
    - Only visually transactions are display differently in list, no calculation changes are applay for fround transactions
    - User can make transaction as fraud and also unmark them
12. As a User, I see the total sum of Transactions in a virtual Wallet separated
    into incoming and outgoing transactions.
    - User can see total incoming and total outgoing amount in wallet
    - this information will be show in transaction list and also in list where user wallets list are shown

## More info
1. there is included basic tests
    - test user registration validation
    - test transaction registration validation
2. there is access validation for users to visit certain pages
    - basic profile validation (only auth users can see pages for wallets and transactions)
    - only user who are related to wallet can see wallets or transactions
3. amounts in database are stored in cents: user input `100` in database will be
represented as `10000`
4. There is implemented several user action limitation to prevent wallet to go
in negative values

## Setup guide
1. Clone this reposotory.
2. Copy `.env.example` as `.env` (change db configs if needed, but everything should be working by default)
3. Build project `docker-compose build` from folder where `docker-compose.yaml` is located
4. Run Docker containers `docker-compose up -d`
5. install all dependencies (Composer) `docker exec box composer install`,
6. install all dependencies (NPM) `docker exec box npm install`
7. Build Css and JS files for public `docker exec box npm run dev`
8. Migrate database `docker exec php php artisan migrate`
9. open http://127.0.0.1:8000

- (optional) You laos could migrate database with seed `docker exec php php artisan migrate -seed`
there will be set of test users
---
Trouble building docker file? Try `docker-compose build --force-rm --no-cache`

## Seeded database user info
1. Seeding database there will be 2 user, each user will have 2 wallets and
each wallet will have 4 trasnactions
2. test users will be 
    - test user 1: email `test0@test.te` password `password`
    - test user 2: email `test1@test.te` password `password`