<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Criteria\ArticleCriteria;
use App\Domain\Entity\Article\Article;
use App\Domain\Repositories\ArticleRepository as DomainRepository;
use App\Domain\ValueObject\Id\ArticleId;
use App\Infrastructure\DTO\ArticleDTO;
use Illuminate\Database\Eloquent\Collection;

/**
 * 記事リポジトリ実装クラス
 */
final class ArticleRepository extends Repository implements DomainRepository
{
    /**
     * 記事DTOクラス
     *
     * @var ArticleDTO
     */
    private ArticleDTO $articleDTO;

    /**
     * コンストラクタインジェクション
     *
     * @param ArticleDTO $articleDto
     */
    public function __construct(ArticleDTO $articleDto)
    {
        $this->articleDto = $articleDto;
    }

    /**
     * @param ArticleId $articleId
     * @return Article
     */
    public function findOneById(ArticleId $articleId): Article
    {
        $articleCollection = $this->articleDTO
            ->find($articleId);

        $articles = [];
        foreach ($articleCollection as $articleData)
            $articles = new Article(
                $articleData->id(),
                $articleData->title(),
                $articleData->type(),
                $articleData->content()
            );

        return $articles;
    }

    /**
     * @param ArticleCriteria $criteria
     * @return Article
     */
    public function findAllByCriteria(ArticleCriteria $criteria): Article
    {
        $articleCollection =  $this->articleDTO
            ->sortBy($criteria->order())
            ->take($criteria->limit())
            ->all();

        $articles = [];
        foreach ($articleCollection as $articleData)
            $articles = new Article(
                $articleData->id(),
                $articleData->title(),
                $articleData->type(),
                $articleData->content()
            );

        return $articles;
    }

    /**
     * @param Article $article
     * @return void
     */
    public function create(Article $article): void
    {
        $this->articleDTO
            ->create([
                'id'      => $article->id(),
                'title'   => $article->title(),
                'type'    => $article->type(),
                'content' => $article->content()
            ]);
    }

    /**
     * @param Article $article
     * @return void
     */
    public function update(Article $article): void
    {
        $this->articleDTO
            ->fill([
                'id'      => $article->id(),
                'title'   => $article->title(),
                'type'    => $article->type(),
                'content' => $article->content()
            ])->save();
    }

    /**
     * @param Article $article
     * @return void
     */
    public function delete(Article $article): void
    {
        $this->articleDTO
            ->destroy($article->id());
    }
}
