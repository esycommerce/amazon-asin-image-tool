Code logic

1. Create a base URL path for Amazon product pages
2. Pass and append ASIN value to the base URL argument
3. Download the HTML DOM source for the ASIN product page
4. Search for the JavaScript object array containing the image URLs
5. Parse the object array into JSON
6. Create an array of image URLs with HiRes attribute
7. Create a directory with ASIN as directory name
8. Download all images from the URLs array into the directory created
9. Pack the directory into ZIP format
10. Download the ZIP file

Error handling

1. Check for PHP timeout / memory handling
2. Validate ASIN and skip invalid
