# QuestBlue Genesis

A PHP library providing a fluent interface for interacting with the QuestBlue API. Built with PHP 8.2+ and modern programming practices.

## Installation

```bash
composer require questblue/genesis
```

## Quick Start

```php
$genesis = Genesis::make()
    ->username('your-username')
    ->password('your-password')
    ->apiKey('your-api-key')
    ->sandbox(true); // Use false for production
```

## Core Features

### Company Management

```php
// Create a new company
$response = $genesis->secureFax()
    ->company()
    ->create('Acme Corporation');

$company = $response->dto();

// Get company details
$companyDetails = $genesis->secureFax()
    ->company()
    ->get($company->id);

// Update company
$genesis->secureFax()
    ->company()
    ->update($company->id, [
        'name' => 'Acme Corp Updated'
    ]);
```

### DID Management

```php
// Create a new DID
$didResponse = $genesis->secureFax()
    ->did()
    ->create(
        number: '+1234567890',
        company: $company->id,
        name: 'Main Line'
    );

// Delete a DID
$genesis->secureFax()
    ->did()
    ->delete($didResponse->dto()->id);
```

### Administrator Management

```php
// Create a new administrator
$adminResponse = $genesis->secureFax()
    ->manager()
    ->create(
        email: 'admin@example.com',
        password: 'secure-password',
        company: $company->id,
        fullName: 'John Doe'
    );
```

## Configuration

### Environment Setup

```php
// Development environment
$genesis = Genesis::make()
    ->username('username')
    ->password('password')
    ->apiKey('api-key')
    ->sandbox(true);

// Production environment
$genesis = Genesis::make()
    ->username('username')
    ->password('password')
    ->apiKey('api-key')
    ->sandbox(false);
```

## Response Handling

All API responses are wrapped in response objects that provide access to both raw data and typed DTOs:

```php
$response = $genesis->secureFax()
    ->company()
    ->create('New Company');

// Get the DTO
$company = $response->dto();

// Get the JSON decoded body of the response as an array or scalar value.
$jsonData = $response->json();

// Get the JSON decoded body as an array.
// Provide a key to find a specific item in the JSON.
$array = $response->array();

// Get the body of the response as string.
$body = $response->body();

// Create a PSR response from the raw response.
$psrResponse = $response->getPsrResponse();

// Get the PSR-7 request
$psrRequest = $response->getPsrRequest();

// Get the status code of the response.
$status = $response->status();

// Save the body to a file
$response->saveBodyToFile('response.txt');

// Check if request was successful
if ($response->successful()) {
    // Handle success
}

// Check if request failed
if ($response->failed()) {
    // Handle failure
}
```

## Best Practices

1. Use DTOs for type-safe data handling
2. Keep track of API keys

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

For support and questions, please contact support@questblue.com.
