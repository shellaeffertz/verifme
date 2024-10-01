<?php

return [
    'bank_accounts' => [
        'public' => [
            'country' => 'required|string|max:255|in:' . implode(',', config('country')),
            'description' => 'nullable|string',
            'account_type' => 'required|in:personal,business'
        ],
        'private' => [
            'account_details' => 'nullable|string|max:3000|required_if:delivery_type,instant',
            'document_links'=> 'nullable|string|max:3000',
        ],
        'requires_check' => false,
    ],
    'payement_processors' => [
        'public' => [
            'country' => 'required|string|max:255|in:' . implode(',', config('country')),
            'description' => 'nullable|string',
            'account_type' => 'required|in:personal,business'
        ],
        'private' => [
            'account_details' => 'nullable|string|max:3000|required_if:delivery_type,instant',
        ],
        'requires_check' => false,
    ],
    'crypto_exchanges' => [
        'public' => [
            'country' => 'required|string|max:255|in:' . implode(',', config('country')),
            'description' => 'nullable|string',
            'account_type' => 'required|in:personal,business'
        ],
        'private' => [
            'account_details' => 'nullable|string|max:3000|required_if:delivery_type,instant',
        ],
        'requires_check' => false,
    ],
    'cracked_account' => [
        'public' => [
            'country' => 'required|string|max:255|in:' . implode(',', config('country')),
            'description' => 'nullable|string',
        ],
        'private' => [
            'account_details' => 'nullable|string|max:3000|required_if:delivery_type,instant',
            'document_links'=> 'nullable|string|max:3000',
        ],
        'requires_check' => false,
    ],
    'real_fakedocs' => [
        'public' => [
            'country' => 'required|string|max:255|in:' . implode(',', config('country')),
            'description' => 'nullable|string',
            'account_type' => 'required|in:personal,business'
        ],
        'private' => [
            'account_details' => 'nullable|string|max:3000|required_if:delivery_type,instant',
            'document_links'=> 'nullable|string|max:3000',
        ],
        'requires_check' => false,
    ],
]; 
