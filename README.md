# Multiple Expanded Entity Choice Issue

Repo of the issue I have with entity choice fields when using `multiple => true`
and `expanded => true`.

## Set Up

Clone the repo:

`git clone git@github.com:domudall/multiple-expanded-entity-choice-issue`

Install the vendors using composer:

`composer install`

Change your `app/config/parameters.yml` to your dev database details.

Create the database and schema:

````
php app/console doctrine:database:create
php app/console doctrine:schema:update
````

Run the project (if PHP 5.4):

`php app/console server:run -v`

If you're not on PHP 5.4, do the usual thing that gets you to a Symfony project.

## Demonstration

Visit `/product/` and add a few products:
* Product 1
* Product 2
* Product 3
* Product 4

Visit `/category/` and add a category 'Category Even'. Select the even products
and press save. Refresh the page.

The category view page should then show the categories with associated products
underneath, in this scenario, none.

Visit `/product/` and add a new product 'Product 6' under the category 'Category
Even'. When you visit `/category/` now, you will see that 'Category Even' shows
'Product 6'.

Merp.