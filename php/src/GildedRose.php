<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    /**
     * The original method from the GildedRose class
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name !== 'Aged Brie' and $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name !== 'Aged Brie') {
                    if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }

    /**
     * This can now replace the above original method
     * updateQuality() method
     */
    public function updateItem(): void
    {
        foreach ($this->items as $item) {
            $this->updateItemQuality($item);
            $this->updateItemSellIn($item);
        }
    }

    public function updateItemSellIn(Item $item): void
    {
        if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
            $item->sellIn--;
        }
    }

    public function updateStandardItemQuality(Item $item): void
    {
        $item->quality = ($item->sellIn > 0) ? ($item->quality - 1) : ($item->quality - 2);

        if ($item->quality <= 0) {
            $item->quality = 0;
        }
    }

    /**
     * @todo I've refactored this method to be aligned with the legacy system
     * however it doesn't align with the requirements given. There is no mention of
     * the quality of Aged Brie increasing by 2 after the sell by date has passed.
     */
    public function updateAgedBrieQuality(Item $item): void
    {
        if ($item->sellIn > 0) {
            $item->quality++;
        } else {
            $item->quality += 2;
        }

        if ($item->quality >= 50) {
            $item->quality = 50;
        }
    }

    public function updateSulfurasHandOfRagnarosQuality(Item $item): void
    {
        // Do nothing to the quality is always 80
        $item->quality = 80;
    }

    public function updateBackstagePassesQuality(Item $item): void
    {
        if ($item->sellIn <= 0) {
            $item->quality = 0;
        } elseif ($item->sellIn <= 5) {
            $item->quality += 3;
        } elseif ($item->sellIn <= 10) {
            $item->quality += 2;
        } else {
            $item->quality++;
        }

        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }

    public function updateItemQuality(Item $item): void
    {
        if ($this->isConjuredItem($item)) {
            $this->updateConjuredItemQuality($item);
        } else {
            switch ($item->name) {
                case 'Aged Brie':
                    $this->updateAgedBrieQuality($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateBackstagePassesQuality($item);
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $this->updateSulfurasHandOfRagnarosQuality($item);
                    break;
                default:
                    $this->updateStandardItemQuality($item);
            }
        }
    }

    public function updateConjuredItemQuality(Item $item): void
    {
        $item->quality = $item->quality - 2;

        if ($item->quality <= 0) {
            $item->quality = 0;
        }
    }

    public function isConjuredItem(Item $item): bool
    {
        if (strpos($item->name, 'Conjured') !== false) {
            return true;
        }
        return false;
    }
}
