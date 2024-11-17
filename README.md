# To run this project use the following command:

make run
make migrate

# Then enter to -> http://127.0.0.1:8080/

# To test the list of products use the following route -> http://127.0.0.1:8080/products?category=1

# If you don't have Make install in your linux device use the following command:
sudo apt install make

# To execute all test run the following command
make paratest


Product relationship with Price entity does not work properly instead of using it I create a VO and from SQL
result I obtain all price by a product id. I know is not the most efficient way, but I cannot figure out why my relationships
didn't work.

