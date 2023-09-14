Feature: Manage blog posts
  @createSchema
  Scenario: Create a blog post
    Given I am authenticated as "admin"
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/blog_posts" with body:
    """
    {
      "title": "Hello a title",
      "content": "The content is suppose to be at least 20 characters",
      "slug": "a-new-slug"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the JSON matches expected template
    """
    {
      "@context": "/api/contexts/BlogPost",
      "@id": "@string@",
      "@type": "BlogPost",
      "comments": [],
      "id": @integer@,
      "title": "Hello a title",
      "published": "@string@.isDateTime()",
      "content": "The content is suppose to be at least 20 characters",
      "slug": "a-new-slug",
      "author": "/api/users/1",
      "images": []
    }
    """

  @createSchema
  Scenario: Throws an error when blog post is invalid
    Given I am authenticated as "admin"
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/blog_posts" with body:
    """
    {
      "title": "",
      "content": "",
      "slug": "a-new-slug"
    }
    """
    Then the response status code should be 422
    And the response should be in JSON
    And the JSON matches expected template
    """
    {
    "@context": "/api/contexts/ConstraintViolationList",
    "@type": "ConstraintViolationList",
    "hydra:title": "An error occurred",
    "hydra:description": "title: This value should not be blank.\ntitle: This value is too short. It should have 10 characters or more.\ncontent: This value should not be blank.\ncontent: This value is too short. It should have 20 characters or more.",
    "violations": [
    {
            "propertyPath": "title",
            "message": "This value should not be blank.",
            "code": "c1051bb4-d103-4f74-8988-acbcafc7fdc3"
        },
        {
            "propertyPath": "title",
            "message": "This value is too short. It should have 10 characters or more.",
            "code": "9ff3fdc4-b214-49db-8718-39c315e33d45"
        },
        {
            "propertyPath": "content",
            "message": "This value should not be blank.",
            "code": "c1051bb4-d103-4f74-8988-acbcafc7fdc3"
        },
        {
            "propertyPath": "content",
            "message": "This value is too short. It should have 20 characters or more.",
            "code": "9ff3fdc4-b214-49db-8718-39c315e33d45"
        }
      ]
    }
    """

  @createSchema
  Scenario: Throws an error when user is not authenticated
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/api/blog_posts" with body:
    """
    {
      "title": "",
      "content": "",
      "slug": "a-new-slug"
    }
    """
    Then the response status code should be 401
