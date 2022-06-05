## About this website

This is a website that allows parents to set up a birth list with all the articles that the admin scraped from 3 other webshops :
- Mimi Baby
- Kabine
- Baby Corner

## Use 

If you want to try the admin side : [admin@gmail.com]   Password : [admin123]
If you want to try the parent side : [parent@gmail.com] Password : [parent123]

If you want to register you'll be automatically registered as a parent, so you don't have to use the parent email.

When a list is made by a parent, the url is made from the current URL, so if you're on localhost and you make a list, you can't reach it if you look on the deployed version, only a deployed version made list can be viewed on a deployment version of the website

The
re are a couple thing not included in my website that should've been in it, but time was running out and
i was too much of a procrastinator to begin on time.

A couple of the missing functions are :

- Shopping List is not included // As well as the payment API that is connected to it

- If a user clicked on Buy on the BabyList, they don't receive an email and the page fails to load again, but the Article that they should've bought
is now disabled and they cant click on it again.

- The prices were not add up to each other // partly because i didn't do the shopping list and because the values in the database were string because the scraper
got some of the price values with a space in front and trim() wasn't working, so i could't convert to float.

- The admin can't close a list but they can delete it.

- I don't have a fancy Home screen because again I ran out of time to style it all

## Local

if you want to run this locally, change the .env.example to .env and fill in the Database settings to run is properly

## Ending notes

In the end it is completely my fault for procrastinating so much for something which i can do if i put the time in it, my apologies and i will try to improve on this, as i will try to improve my way of coding :)
