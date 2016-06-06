FORMAT: 1A

# Nonprofits API
Search Nonprofit organizations

# Group Nonprofits

## Search Nonprofits [GET /api/nonprofits/search{?q}]
Searches nonprofits given partial names, or city, or state, or ein or any combinations of them.

+ Parameters
    + q (string)

      Search Query for the nonprofits

+ Response 200 (application/json)
    + Attributes (object)
        + data (array[Nonprofit])

# Data Structures

## Nonprofit (object)
+ id: 25 (number)
    A positive id that points to the database
+ ein: 0012343 (string)
+ name: Chicago Art House (string)
+ city: Chicago (string)
+ state: IL (string)
+ deductibility_status_code: PE,SOUNK (array[string])
