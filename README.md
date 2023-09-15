----------------------------------------- Experien2e Second Hand Store ---------------------------------------------

This Web application was created as a school project in the course "Systemutveckling PHP" using PHP and MySQL.
REPO must be cloned into your htdocs folder. Use extension Thunder Client or an API Platform such as Postman to GET/PUT/POST/DELETE.

------SELLERS--------

Show all sellers (Sorted in alphabetical order by name):

GET localhost/experien2e/sellers/

---

Show specific seller info and display all items listed by the seller. Different numbers {id} shows different sellers:

GET localhost/experien2e/sellers/{id}

---

Add (POST) a new seller:

POST a seller to localhost/experien2e/sellers/ using templates such as:

  {
    "name": "Mattias",
    "lastname": "Mattisson",
    "total_items": 2,
    "total_items_sold": 1,
    "total_sales": 800
  }

------ITEMS--------

Show all items (Sorted by id):

GET localhost/experien2e/items/

--

Show an item by id:

GET localhost/experien2e/items/{id}

--

Add (POST) listed item to localhost/experien2e/items/ using templates such as:

 {
    "item_name": "Calvin Klein Tee",
    "seller_id": 7,
    "sbmt_date": "2023-09-10",
    "price": 300,
    "sold": 0,   <--- 0 = not sold. 1 = sold.
    "sold_date": "0000-00-00"
  }

--

Mark item as sold:

PUT localhost/experien2e/items{id}:   ---- ID in url same as item_id

------------------------------------------------------------------------------------------------------

And that's it!
