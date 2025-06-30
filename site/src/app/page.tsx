"use client";

import { useEffect, useState } from "react";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/api/product/get";
import ProductList from "@/components/layout/product/product-list";

export default function Home() {
  const [products, setProducts] = useState<IProduct[]>([]);

  useEffect(() => {
    const loadProducts = async () => {
      const fetchedProducts = await fetchProducts();
      setProducts(fetchedProducts);
    };
    loadProducts();
  }, []);

  return (
    <section className="w-full py-4">
      <h2>Produtos</h2>
      <ProductList products={products} />
    </section>
  );
}
