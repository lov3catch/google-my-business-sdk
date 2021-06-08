<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests;

use GoogleMyBusiness\Api\ReviewApi;
use GoogleMyBusiness\Api\VO\Review;
use GoogleMyBusiness\Api\VO\ReviewReply;
use GoogleMyBusiness\Tests\Fake\FakeTokenProvider;
use GoogleMyBusinessMock\GoogleMyBusinessFakeHttpClient;
use PHPUnit\Framework\TestCase;

class ReviewApiTest extends TestCase
{
    public function testList(): void
    {
        $reviewApi = new ReviewApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $reviews = $reviewApi->list('accounts/108494581129006735086/locations/6394464039148850881');

        self::assertNotEmpty($reviews);

        /**
         * @var $reviews Review[]
         */
        foreach ($reviews as $review) {
            self::assertInstanceOf(Review::class, $review, 'Wrong instance of');
            self::assertInstanceOf(ReviewReply::class, $review->reviewReply());
        }
    }

    public function testDetails(): void
    {
        $reviewApi = new ReviewApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $review = $reviewApi->get(
            'accounts/108494581129006735086/locations/13195921940790549583/reviews/AbFvOqmDfUP0EhJuYm-w3KXy3gSxYn-NS9CiDOo4tOjO4PRuq4PWUWbGkh6K-fePdKQaXi0cycFGGg'
        );

        self::assertInstanceOf(Review::class, $review);
        self::assertTrue($review->hasReply());
        self::assertInstanceOf(ReviewReply::class, $review->reviewReply());
    }
}