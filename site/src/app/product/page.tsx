"use client";

import ProductList from "@/components/layout/product/product-list";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/product/get";
import { useEffect, useState } from "react";

const HomeProduct = () => {
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
      <h1 className="text-2xl font-bold mb-4">Página de Produto</h1>
      <p>
        Esta é a página de produto. Aqui você pode exibir detalhes específicos
        do produto.
      </p>
      {/* Aqui você pode adicionar mais conteúdo relacionado ao produto */}
      <section className="w-full py-4">
        <h2>Produtos</h2>
        <ProductList products={products} />
      </section>
    </div>
  );
};

export default HomeProduct;
