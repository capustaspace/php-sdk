<?php


namespace Capusta\SDK\Model;


final class PayoutStatuses
{
    /** @var string Выплата иницилизирована и находится в очереди на выполнение. */
    const STATUS_CREATED = 'CREATED';

    /** @var string Выплата в процессе на стороне платежной системы. */
    const STATUS_PROCESSING = 'PROCESSING';

    /** @var string Выплата успешно завершена. Это финальный и неизменяемый статус. */
    const STATUS_SUCCESS = 'SUCCESS';

    /** @var string Выплата была отклонена платежной системой. Это финальный и неизменяемый статус. */
    const STATUS_ERROR = 'ERROR';
    const STATUS_NEED_CONFIRMATION = 'NEED_CONFIRMATION';
    const STATUS_DECLINE = 'DECLINE';
    const STATUS_UNKNOWN = 'UNKNOWN';

    public static function getStatuses()
    {
        return [
            self::STATUS_CREATED,
            self::STATUS_PROCESSING,
            self::STATUS_SUCCESS,
            self::STATUS_NEED_CONFIRMATION,
            self::STATUS_DECLINE,
            self::STATUS_ERROR,
            self::STATUS_UNKNOWN
        ];
    }
}
