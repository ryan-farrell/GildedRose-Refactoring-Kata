<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testUpdateItemSellInReducesSellInCorrectly(): void
    {
        $item = new Item('foo', 2, 2);
        (new GildedRose([$item]))->updateItemSellIn($item);

        $this->assertSame('foo', $item->name);
        $this->assertSame(1, $item->sellIn);

        $item = new Item('foo', 0, 2);
        (new GildedRose([$item]))->updateItemSellIn($item);

        $this->assertSame('foo', $item->name);
        $this->assertSame(-1, $item->sellIn);
    }

    public function testUpdateStandardItemQualityIsCorrect(): void
    {
        $item = new Item('foo', 2, 2);
        (new GildedRose([$item]))->updateStandardItemQuality($item);

        $this->assertSame('foo', $item->name);
        $this->assertSame(1, $item->quality);

        $item = new Item('foo_zero', 0, 0);
        (new GildedRose([$item]))->updateStandardItemQuality($item);

        $this->assertSame('foo_zero', $item->name);
        $this->assertSame(0, $item->quality);

        $item = new Item('foo_zero', -5, 10);
        (new GildedRose([$item]))->updateStandardItemQuality($item);

        $this->assertSame('foo_zero', $item->name);
        $this->assertSame(8, $item->quality);
    }

    public function testUpdateAgedBrieItemQualityIsCorrect(): void
    {
        $item = new Item('Aged Brie', 2, 2);
        (new GildedRose([$item]))->updateAgedBrieQuality($item);

        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(3, $item->quality);

        $item = new Item('Aged Brie', 0, 0);
        (new GildedRose([$item]))->updateAgedBrieQuality($item);

        /** @todo Amended assertions inline with legacy output, NOT requirements */
        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(2, $item->quality);

        $item = new Item('Aged Brie', -5, 10);
        (new GildedRose([$item]))->updateAgedBrieQuality($item);

        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(12, $item->quality);
    }

    public function testUpdateSulfurasHandOfRagnarosQualityIsCorrect(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 2, 2);
        (new GildedRose([$item]))->updateSulfurasHandOfRagnarosQuality($item);

        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name);
        $this->assertSame(80, $item->quality);

        $item = new Item('Sulfuras, Hand of Ragnaros', 0, 80);
        (new GildedRose([$item]))->updateSulfurasHandOfRagnarosQuality($item);

        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name);
        $this->assertSame(80, $item->quality);

        $item = new Item('Sulfuras, Hand of Ragnaros', -5, 10);
        (new GildedRose([$item]))->updateSulfurasHandOfRagnarosQuality($item);

        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name);
        $this->assertSame(80, $item->quality);
    }

    public function testUpdateBackstagePassesQualityIsCorrect(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 11, 2);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(3, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 2);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(4, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 6, 2);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(4, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 2);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(5, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 1, 10);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(13, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 0);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(0, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 2, 48);
        (new GildedRose([$item]))->updateBackstagePassesQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(50, $item->quality);
    }

    public function testUpdateItemQualityCallsCorrectlyUpdatesTheQuality(): void
    {
        $item = new Item('Aged Brie', 11, 2);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(3, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 4, 2);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(5, $item->quality);

        $item = new Item('Sulfuras, Hand of Ragnaros', 2, 2);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name);
        $this->assertSame(80, $item->quality);

        $item = new Item('Foo Bar', 2, 2);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Foo Bar', $item->name);
        $this->assertSame(1, $item->quality);

        $item = new Item('Conjured Mana Cake', 4, 4);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(2, $item->quality);

        $item = new Item('Conjured Mana Cake', 2, 2);
        (new GildedRose([$item]))->updateItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(0, $item->quality);
    }

    public function testUpdateItemsUpdatesDifferentItemsCorrectly(): void
    {
        $item = new Item('Foo Bar', 2, 2);
        (new GildedRose([$item]))->updateItem();
        $this->assertSame('Foo Bar', $item->name);
        $this->assertSame(1, $item->sellIn);
        $this->assertSame(1, $item->quality);

        $item = new Item('Aged Brie', 2, 2);
        (new GildedRose([$item]))->updateItem();
        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(1, $item->sellIn);
        $this->assertSame(3, $item->quality);

        $item = new Item('Aged Brie', 2, 50);
        (new GildedRose([$item]))->updateItem();
        $this->assertSame('Aged Brie', $item->name);
        $this->assertSame(1, $item->sellIn);
        $this->assertSame(50, $item->quality);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 1, 0);
        (new GildedRose([$item]))->updateItem();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame(0, $item->sellIn);
        $this->assertSame(3, $item->quality);

        $item = new Item('Sulfuras, Hand of Ragnaros', -5, 10);
        (new GildedRose([$item]))->updateItem();
        $this->assertSame('Sulfuras, Hand of Ragnaros', $item->name);
        $this->assertSame(-5, $item->sellIn);
        $this->assertSame(80, $item->quality);
    }

    public function testAlignWithOutputFromApprovalTestAfterFirstDay(): void
    {
        // Initial
        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
        ];

        (new GildedRose($items))->updateItem();

        // Day 1
        $this->assertSame('+5 Dexterity Vest, 9, 19', (string) $items[0]);
        $this->assertSame('Aged Brie, 1, 1', (string) $items[1]);
        $this->assertSame('Elixir of the Mongoose, 4, 6', (string) $items[2]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, 0, 80', (string) $items[3]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, -1, 80', (string) $items[4]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, 14, 21', (string) $items[5]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, 9, 50', (string) $items[6]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, 4, 50', (string) $items[7]);
    }

    public function testAlignWithOutputFromApprovalTestAfter10thDay(): void
    {
        // 10th Day
        $items = [
            new Item('+5 Dexterity Vest', 0, 10),
            new Item('Aged Brie', -8, 18),
            new Item('Elixir of the Mongoose', -5, 0),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 35),
            new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50),
            new Item('Backstage passes to a TAFKAL80ETC concert', -5, 0),
        ];

        (new GildedRose($items))->updateItem();

        // 11th Day
        $this->assertSame('+5 Dexterity Vest, -1, 8', (string) $items[0]);
        $this->assertSame('Aged Brie, -9, 20', (string) $items[1]);
        $this->assertSame('Elixir of the Mongoose, -6, 0', (string) $items[2]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, 0, 80', (string) $items[3]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, -1, 80', (string) $items[4]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, 4, 38', (string) $items[5]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, -1, 0', (string) $items[6]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, -6, 0', (string) $items[7]);
    }

    public function testAlignWithOutputFromApprovalTestAfter26thDay(): void
    {
        // 26th Day
        $items = [
            new Item('+5 Dexterity Vest', -16, 0),
            new Item('Aged Brie', -24, 50),
            new Item('Elixir of the Mongoose', -21, 0),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', -11, 0),
            new Item('Backstage passes to a TAFKAL80ETC concert', -16, 0),
            new Item('Backstage passes to a TAFKAL80ETC concert', -21, 0),
        ];

        (new GildedRose($items))->updateItem();

        // 27th Day
        $this->assertSame('+5 Dexterity Vest, -17, 0', (string) $items[0]);
        $this->assertSame('Aged Brie, -25, 50', (string) $items[1]);
        $this->assertSame('Elixir of the Mongoose, -22, 0', (string) $items[2]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, 0, 80', (string) $items[3]);
        $this->assertSame('Sulfuras, Hand of Ragnaros, -1, 80', (string) $items[4]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, -12, 0', (string) $items[5]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, -17, 0', (string) $items[6]);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert, -22, 0', (string) $items[7]);
    }

    // Does the item name contain "Conjured"
    public function testIsItemAConjuredItemReturnTrueIfItemNameContainsConjured(): void
    {
        $item = new Item('Conjured Mana Cake', 3, 6);
        $this->assertTrue((new GildedRose([$item]))->isConjuredItem($item));

        $item = new Item('Mana Cake', 3, 6);
        $this->assertFalse((new GildedRose([$item]))->isConjuredItem($item));

        $item = new Item('Conjured Invisible Vest', 3, 6);
        $this->assertTrue((new GildedRose([$item]))->isConjuredItem($item));
    }

    /**
     * This test was a sanity check of the original approved test creates the same output as
     * the refactored code, a before and after comparison.
     */
    public function testOriginalAndNewApprovalFilesAreEqual(): void
    {
        $file1 = './tests/comparison/ApprovalTest.testThirtyDaysOriginal.approved.txt';
        $file2 = './tests/comparison/ApprovalTest.testThirtyDaysRefactored.approved.txt';

        $this->assertFileEquals($file1, $file2);
    }

    public function testUpdateConjuredItemQualityIsCorrect(): void
    {
        $item = new Item('Conjured Mana Cake', 10, 10);
        (new GildedRose([$item]))->updateConjuredItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(8, $item->quality);

        $item = new Item('Conjured Mana Cake', 2, 2);
        (new GildedRose([$item]))->updateConjuredItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(0, $item->quality);

        $item = new Item('Conjured Mana Cake', 1, 0);
        (new GildedRose([$item]))->updateConjuredItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(0, $item->quality);

        $item = new Item('Conjured Mana Cake', -5, 0);
        (new GildedRose([$item]))->updateConjuredItemQuality($item);
        $this->assertSame('Conjured Mana Cake', $item->name);
        $this->assertSame(0, $item->quality);
    }
}
