<?php

namespace App\Services;

class ProductService
{

    public function searchResults($products)
    {
        $searchDisplay = '';

        foreach ($products as $product) {
            $quantityStatus = $product->quantity . ' '; // Display quantity first
            $quantityStatus .= $product->quantity < 50
                ? '<span class="bg-red-500 text-white text-[12px] px-1 rounded">Low</span>'
                : ($product->quantity < 100
                    ? '<span class="bg-yellow-500 text-white text-[12px] px-1 rounded">Low</span>'
                    : '');


            $searchDisplay .= '
        <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-4">' . $product->name . '</td>
            <td class="px-6 py-4">' . $product->description . '</td>
            <td class="px-6 py-4">' . $product->category->name . '</td>
            <td class="px-6 py-4">' . $quantityStatus . '</td>
            <td class="px-6 py-4">' . $product->buying_price . '</td>
            <td class="px-6 py-4">' . $product->selling_price . '</td>
            <td class="px-6 py-4 text-right space-x-2 flex items-center">
                <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
                    href="' . route('products.edit', ['product' => $product->id]) . '">
                    <svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <span class="hidden md:block">Edit</span>
                </a>
                <form action="' . route('products.destroy', ['product' => $product->id]) . '" method="post">
                     ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                    <button class="font-medium text-white bg-red-600 px-2 py-1 rounded hover:bg-red-700 flex items-center justify-center gap-1 w-fit" type="submit">
                        <svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        <span class="hidden md:block">Delete</span>
                    </button>
                </form>
            </td>
        </tr>';
        }

        return $searchDisplay;
    }
}
