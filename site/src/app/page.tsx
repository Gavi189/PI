"use client";

import { useEffect, useState } from "react";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/product/get";
import ProductList from "@/components/layout/product/product-list";
import { BannerHome } from "@/components/layout/banner";

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
    <div>
      <BannerHome />
      <section className="w-full py-4">
        <h2>Produtos</h2>
        <ProductList products={products} />
      </section>
    </div>
  );
}
