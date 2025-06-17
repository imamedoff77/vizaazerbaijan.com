<?php

namespace App\Enums;

enum VisaStatusEnum: int
{

    case PAYMENT_PENDING = 1; // Ödəniş gözləyir
    case AWAITING_APPROVAL = 2; // Təsdiq gözləyir
    case CANCELLED = 3; // Rədd edilib
    case COMPLETED = 4; // Tamamlanıb

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }


    /**
     * @param int $status
     * @return string
     */
    public static function getStatusName(int $status): string
    {
        return match ($status) {
            self::PAYMENT_PENDING->value => 'Pending payment',
            self::AWAITING_APPROVAL->value => 'Awaiting approval',
            self::CANCELLED->value => 'Cancelled',
            self::COMPLETED->value => 'Completed',
            default => 'Unknown',
        };
    }

    /**
     * @return array
     */
    public static function getStatusArray(): array
    {
        return [
            self::PAYMENT_PENDING->value => self::getStatusName(self::PAYMENT_PENDING->value),
            self::AWAITING_APPROVAL->value => self::getStatusName(self::AWAITING_APPROVAL->value),
            self::CANCELLED->value => self::getStatusName(self::CANCELLED->value),
            self::COMPLETED->value => self::getStatusName(self::COMPLETED->value),
        ];
    }
}
