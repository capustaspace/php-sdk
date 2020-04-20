<?php


namespace Capusta\SDK\Model;


final class PaymentStatuses
{
    /** @var string Платеж создан, ожидается проведение платежа. */
    const STATUS_CREATED = 'CREATED';

    /** @var string Платеж находится в процессе оплаты на стороне платежной системы. */
    const STATUS_PROCESSING = 'PROCESSING';

    /** @var string Платеж успешно завершен и по нему были зачислены деньги. Это финальный и неизменяемый статус. */
    const STATUS_SUCCESS = 'SUCCESS';

    /** @var string Платеж является двухэтапным и ожидает подтверждения или отмены. */
    const STATUS_NEED_CONFIRMATION = 'NEED_CONFIRMATION';

    /** @var string Платеж был отвергнут банком-эмитентом или платежным сервисом, отменен или истекло время подтверждения платежа. */
    const STATUS_FAILED = 'FAILED';

    /** @var string  */
    const STATUS_DECLINE = 'DECLINE';

    /** @var string Успешный возврат. Каждый возврат проходит в системе отдельной операцией. */
    const STATUS_REFUND_SUCCESS = 'REFUND_SUCCESS';

    /** @var string Возврат находится в процессе обработки на стороне платежной системы. */
    const STATUS_REFUND_PROCESSING = 'REFUND_PROCESSING';

    /** @var string  */
    const STATUS_UNKNOWN = 'UNKNOWN';

    public static function getStatuses()
    {
        return [
            self::STATUS_CREATED,
            self::STATUS_PROCESSING,
            self::STATUS_SUCCESS,
            self::STATUS_REFUND_PROCESSING,
            self::STATUS_REFUND_SUCCESS,
            self::STATUS_FAILED,
            self::STATUS_DECLINE,
            self::STATUS_UNKNOWN,
        ];
    }
}
