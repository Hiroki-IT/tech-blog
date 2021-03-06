<?php

declare(strict_types=1);

namespace App\Http\Middleware\Before\Converters;

use App\Converters\ArticleIdConverter;
use Closure;

/**
 * 記事ID変換ミドルウェアクラス
 */
final class ArticleIdConverterMiddleware extends IdConverterMiddleware
{
    /**
     * ArticleIdConverter::convertを実行します．
     *
     * @param string  $id
     * @param Closure $next
     * @return mixed
     */
    public function handle(string $id, Closure $next)
    {
        return $next(ArticleIdConverter::convert($id));
    }
}
