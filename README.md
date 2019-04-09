# Parse the Parcel #

Here we are looking to a new service that shipping costs are based on size and we offer different prices for small, medium, and large boxes. 
Unfortunately we're currently unable to move heavy packages so we've placed an upper limit of 25kg per package.

| Package Type | Length | Breadth | Height | Cost |
| --- | --- | --- | --- | --- | --- |
| Small | 200mm | 300mm | 150mm | $5.00 |
| Medium | 300mm | 400mm | 200mm| $7.50 |
| Large | 400mm | 600mm | 250mm | $8.50 |

## Coding Exercise ##

We need you to implement a component that, when supplied the dimensions (length x breadth x height) and weight of a package, can advise on the cost and type of package required. If the package exceeds these dimensions - or is over 25kg - then the service should not return a packaging solution.

### Guidelines ###

You will be expected to produce a solution that solves the above problem. While this is a simple component we would expect it demonstrate anything you’d normally require for a production ready and supportable solution - so think about standards, legibility, robustness, reuse etc. What we don’t require is a fancy user interface - a simple **command line** or **test harness** will suffice. 

You are free to choose how you implement the solution though your choices should ideally align with your skills and the role you are applying for. You are welcome to make assumptions about the solution along with any improvements you think enhance or add value to the solution - though please be aware of the original scope.

### Submissions ###

We will send you an invite to our Bitbucket git repository where you can commit or upload your code. Once finished let us know via email and we’ll take a look. 

Best of luck, and we look forwards to your response!

### How to run unitTest ###
1, install phpunit7 in global
composer require --dev phpunit/phpunit ^7
2, run phpunit in command line
phpunit ./parcelParserTest.php
