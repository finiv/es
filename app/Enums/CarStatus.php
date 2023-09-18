<?php

namespace App\Enums;

enum CarStatus: string
{
    case NEW = 'new';
    case REGISTRATED = 'registrated';
    case PREPARING_FOR_SALE = 'pending';
    case SALE_APPROVED = 'approved';
    case SALE_DECLINED = 'declined';
    case SOLD = 'sold';
}
