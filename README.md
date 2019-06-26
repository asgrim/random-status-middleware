# Random Status Middleware

Randomise the status code returned from a middleware pipeline.

Given a middleware pipeline, change the HTTP status code to a new random status code.

Inspired by my own tweet: <https://twitter.com/asgrim/status/1143523405335019520>

## Installation 

 - `composer require asgrim/random-status-middleware`

## Usage

Add `\Asgrim\RandomStatusMiddleware\RandomStatusMiddleware` into your middleware pipeline. Probably works best towards
the outermost layer to ensure the status code is not overwritten unintentionally by another middleware.
